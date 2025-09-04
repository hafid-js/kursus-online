<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::with('comments')->where('status', 1)
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $slug = $request->category;
                $query->whereHas('category', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                });
            })
            ->paginate(10);

        return view('frontend.pages.blog', compact('blogs'));
    }

    public function show(string $slug)
    {
        $blog = Blog::with(['author', 'category', 'comments.children.user', 'comments.user'])->where('slug', $slug)->where('status', 1)->firstOrFail();

        $recentBlogs = Blog::where('status', 1)->where('slug', '!=', $slug)->latest()->take(3)->get();
        $blogCategories = BlogCategory::withCount('blogs')->where('status', 1)->get();

        return view('frontend.pages.blog-detail', compact('blog', 'recentBlogs', 'blogCategories'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:blog_comments,id',
        ]);

        $comment = BlogComment::create([
            'blog_id' => $id,
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Comment added successfully.',
            'data' => [
                'id' => $comment->id,
                'parent_id' => $comment->parent_id,
                'comment' => $comment->comment,
                'date' => $comment->created_at->format('M d, Y'),
                'user_name' => $comment->user->name,
                'user_image' => $comment->user->image
                    ? asset($comment->user->image)
                    : asset('default-files/image-profile.png'),
                    'user_id' => $comment->user_id,
            ],
        ]);
    }

    public function destroyComment($id)
    {
        $comment = BlogComment::findOrFail($id);

        if (auth()->id() !== $comment->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment and its replies deleted']);
    }
}
