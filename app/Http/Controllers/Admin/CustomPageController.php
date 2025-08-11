<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CustomPageController extends Controller
{

    public function index()
    {
        $pages = CustomPage::paginate(20);
        return view('admin.custom-page.index', compact('pages'));
    }


    public function create()
    {

        return view('admin.custom-page.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:custom_pages'],
            'description' => ['required', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'show_at_nav' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        $page = new CustomPage();
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->description = $request->description;
        $page->seo_title = $request->seo_title;
        $page->seo_description = $request->seo_description;
        $page->show_at_nav = $request->show_at_nav ?? 0;
        $page->status = $request->status ?? 0;
        $page->save();

        Cache::forget("custom_page_{$page->slug}");

        notyf()->success('Created Successfully');
        return to_route('admin.custom-page.index');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:custom_pages,title,' . $id],
            'description' => ['required', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'show_at_nav' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        $page = CustomPage::findOrFail($id);
        $oldSlug = $page->slug; // Simpan slug lama

        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->description = $request->description;
        $page->seo_title = $request->seo_title;
        $page->seo_description = $request->seo_description;
        $page->show_at_nav = $request->show_at_nav ?? 0;
        $page->status = $request->status ?? 0;
        $page->save();

        // Hapus cache lama dan baru
        Cache::forget("custom_page_{$oldSlug}");
        Cache::forget("custom_page_{$page->slug}");

        notyf()->success('Updated Successfully');
        return to_route('admin.custom-page.index');
    }

    public function destroy(string $id)
    {
        $page = CustomPage::findOrFail($id);

        try {
            $slug = $page->slug;
            $page->delete();

            Cache::forget("custom_page_{$slug}");

            notyf()->success('Delete Succesfully!');
            return response(['message' => 'Delete Successfully!'], 200);
        } catch (Exception $e) {
            logger("Custom Page Error >> " . $e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
