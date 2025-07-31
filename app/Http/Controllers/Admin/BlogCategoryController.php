<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = BlogCategory::paginate(20);
        return view('admin.blog.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:255','unique:blog_categories,name'],
            'status' => ['nullable','boolean'],
        ]);

        $category = new BlogCategory();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success('Created Successfully!');

        return to_route('admin.blog-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','string','max:255','unique:blog_categories,name,'.$id],
            'status' => ['nullable','boolean'],
        ]);

        $category = BlogCategory::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status ?? 0;
        $category->save();

        notyf()->success('Updated Successfully!');

        return to_route('admin.blog-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {
            $category = BlogCategory::findOrFail($id);
            $category->delete();
            notyf()->success('Delete Succesfully!');
            return response(['message' => 'Delete Successfully!'], 200);
        } catch(Exception $e) {
            logger("Blog Category Error >> ".$e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
