<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\RedirectResponse;
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
        $blog = Blog::with(['author', 'category', 'comments'])->where('slug', $slug)->where('status', 1)->firstOrFail();
        $recentBlogs = Blog::where('status', 1)->where('slug', '!=', $slug)->latest()->take(3)->get();
        $blogCategories = BlogCategory::withCount('blogs')->where('status', 1)->get();

        return view('frontend.pages.blog-detail', compact('blog', 'recentBlogs', 'blogCategories'));
    }

    public function storeComment(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'comment' => ['required', 'string', 'min:3', 'max:255'],
            'parent_id' => ['nullable', 'exists:blog_comments,id'],
        ]
        );

        BlogComment::create([
            'user_id' => auth()->id(),
            'blog_id' => $id,
            'parent_id' => $request->parent_id ?? null,
            'comment' => $request->comment,
        ]);

        notyf()->success('Comment Added Successfully!');

        return redirect()->back();
    }
}
