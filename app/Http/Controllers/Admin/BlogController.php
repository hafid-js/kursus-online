<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Traits\FileUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    use FileUpload;

    public function index()
    {
        $blogs = Blog::with('category')->paginate(20);

        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all();

        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:blogs,title'],
            'image' => ['required', 'image', 'max:3000'],
            'description' => ['required', 'string'],
            'category' => ['required', 'exists:blog_categories,id'],
            'status' => ['nullable', 'boolean'],
        ]);

        $image = $this->uploadFile($request->file('image'));

        $blog = new Blog();
        $blog->image = $image;
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->blog_category_id = $request->category;
        $blog->user_id = adminUser()->id;
        $blog->status = $request->status ?? 0;
        $blog->save();

        Cache::forget('homepage_blogs');

        notyf()->success('Created Successfully!');

        return to_route('admin.blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);

        $comments = BlogComment::where('blog_id', $id)
            ->whereNull('parent_id')
            ->with('children.user')
            ->with('user')
            ->get();

        return view('admin.blog.show', compact('blog', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::all();

        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:blogs,title,' . $id],
            'image' => ['nullable', 'image', 'max:3000'],
            'description' => ['required', 'string'],
            'category' => ['required', 'exists:blog_categories,id'],
            'status' => ['nullable', 'boolean'],
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'));
            $this->deleteFile($request->old_image);
            $blog->image = $image;
        }

        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->description;
        $blog->blog_category_id = $request->category;
        $blog->user_id = adminUser()->id;
        $blog->status = $request->status ?? 0;
        $blog->save();

        Cache::forget('homepage_blogs');

        notyf()->success('Updated Successfully!');

        return to_route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        try {
            $blog->delete();
            Cache::forget('homepage_blogs');
            notyf()->success('Delete Succesfully!');

            return response(['message' => 'Delete Successfully!'], 200);
        } catch (\Exception $e) {
            logger('Blog Error >> ' . $e);

            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
