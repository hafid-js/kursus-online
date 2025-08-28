<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogCategory::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        }

        $categories = $query->paginate(20);

        if ($request->ajax() && $request->has('search')) {
            return view('admin.blog.category.partials.table', compact('categories'))->render();
        }

        return view('admin.blog.category.index', compact('categories'));
    }

    public function create()
    {
        $editMode = false;

        return response()->view('admin.blog.category.partials.category-modal', compact('editMode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:blog_categories,name'],
            'status' => ['nullable', 'boolean'],
        ]);

        $category = new BlogCategory();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success('Created Succesfully!');
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Created Successfully!',
                'redirect' => route('admin.blog-categories.index'),
            ]);
        }

        return to_route('admin.blog-categories.index');
    }

    // public function edit(string $id)
    // {
    //     $category = BlogCategory::findOrFail($id);
    //     return view('admin.blog.category.edit', compact('category'));
    // }
    public function edit($id): \Illuminate\Http\Response
    {
        $category = BlogCategory::findOrFail($id);
        $editMode = true;

        return response()->view('admin.blog.category.partials.category-modal', compact('category', 'editMode'));
    }

    public function show()
    {
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:blog_categories,name,' . $id],
            'status' => ['nullable', 'boolean'],
        ]);

        $category = BlogCategory::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success('Updated Succesfully!');
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Updated Successfully!',
                'redirect' => route('admin.blog-categories.index'),
            ]);
        }

        return to_route('admin.blog-categories.index');
    }

    public function destroy(string $id)
    {
        try {
            $category = BlogCategory::findOrFail($id);
            $category->delete();
            notyf()->success('Delete Succesfully!');

            return response(['message' => 'Delete Successfully!'], 200);
        } catch (\Exception $e) {
            logger('Blog Category Error >> ' . $e);

            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
