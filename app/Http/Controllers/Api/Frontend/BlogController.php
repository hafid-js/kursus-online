<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ApiResponseTrait;

    /**
     * List blogs with optional search and category filter
     */
    public function index(Request $request): JsonResponse
    {
        $blogs = Blog::with('comments')
            ->where('status', 1)
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $slug = $request->category;
                $query->whereHas('category', fn ($q) => $q->where('slug', $slug));
            })
            ->paginate(10);

        return $this->sendResponse($blogs, 'Blogs retrieved successfully');
    }

    /**
     * Show single blog detail with relations and metadata
     */
    public function show(string $slug): JsonResponse
    {
        $blog = Blog::with(['author', 'category', 'comments.children.user', 'comments.user'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->first();

        if (!$blog) {
            return $this->sendError('Blog not found', 404);
        }

        $recentBlogs = Blog::where('status', 1)
            ->where('slug', '!=', $slug)
            ->latest()
            ->take(3)
            ->get();

        $blogCategories = BlogCategory::withCount('blogs')
            ->where('status', 1)
            ->get();

        return $this->sendResponse([
            'blog' => $blog,
            'recent_blogs' => $recentBlogs,
            'categories' => $blogCategories,
        ], 'Blog detail retrieved successfully');
    }

    /**
     * Store a comment on blog post
     */
    public function storeComment(Request $request, int $id): JsonResponse
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

        return $this->sendResponse([
            'id' => $comment->id,
            'parent_id' => $comment->parent_id,
            'comment' => $comment->comment,
            'date' => $comment->created_at->format('M d, Y'),
            'user_name' => $comment->user->name,
            'user_image' => $comment->user->image
                ? asset($comment->user->image)
                : asset('default-files/image-profile.png'),
            'user_id' => $comment->user_id,
        ], 'Comment added successfully');
    }

    /**
     * Delete a comment (only owner)
     */
    public function destroyComment(int $id): JsonResponse
    {
        $comment = BlogComment::find($id);

        if (!$comment) {
            return $this->sendError('Comment not found', 404);
        }

        if (auth()->id() !== $comment->user_id) {
            return $this->sendError('Unauthorized', 403);
        }

        $comment->delete();

        return $this->sendResponse(null, 'Comment deleted successfully');
    }
}
