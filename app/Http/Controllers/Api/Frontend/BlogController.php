<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    // list blog posts with optional search and category filters
    public function index(Request $request)
    {
        $blogs = Blog::with(['comments', 'category', 'author'])
            ->where('status', 1)
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            })
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Blog list retrieved successfully.',
            'data' => $blogs,
        ]);
    }

    // show single blog by slug
    public function show($slug)
    {
        $blog = Blog::with(['author', 'category', 'comments.user', 'comments.replies'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $recentBlogs = Blog::where('status', 1)
            ->where('slug', '!=', $slug)
            ->latest()
            ->take(3)
            ->get();

        $categories = BlogCategory::withCount('blogs')
            ->where('status', 1)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Blog detail retrieved.',
            'data' => [
                'blog' => $blog,
                'recent_blogs' => $recentBlogs,
                'categories' => $categories,
            ],
        ]);
    }

    // store a comment on a blog
    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|min:3|max:255',
            'parent_id' => 'nullable|exists:blog_comments,id',
        ]);

        $comment = BlogComment::create([
            'user_id' => Auth::id(),
            'blog_id' => $id,
            'parent_id' => $request->parent_id,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully.',
            'data' => $comment->load('user'),
        ]);
    }
}
