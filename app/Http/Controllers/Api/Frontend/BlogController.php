<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogCategoryResource;
use App\Http\Resources\BlogCommentResource;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
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
            'data' => BlogResource::collection($blogs),
            'pagination' => [
                'current_page' => $blogs->currentPage(),
                'last_page' => $blogs->lastPage(),
                'per_page' => $blogs->perPage(),
                'total' => $blogs->total(),
            ],
        ]);
    }

    public function show($slug)
    {
        $blog = Blog::with(['author', 'category', 'comments.user', 'comments.replies.user'])
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
                'blog' => new BlogResource($blog),
                'recent_blogs' => BlogResource::collection($recentBlogs),
                'categories' => BlogCategoryResource::collection($categories),
            ],
        ]);
    }

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

        $comment->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully.',
            'data' => new BlogCommentResource($comment),
        ]);
    }
}
