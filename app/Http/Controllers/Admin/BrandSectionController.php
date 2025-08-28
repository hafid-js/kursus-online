<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BrandSectionController extends Controller
{
    use FileUpload;

    public function index()
    {
        $brands = Brand::paginate(15);

        return view('admin.sections.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.sections.brand.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'url' => ['required', 'url'],
            'status' => ['required', 'boolean'],
        ]);

        $imagePath = $this->uploadFile($request->file('image'));

        $brand = new Brand();
        $brand->image = $imagePath;
        $brand->url = $request->url;
        $brand->status = $request->status;
        $brand->save();

        notyf()->success('Created Successfully!');

        return redirect()->route('admin.brand-section.index');
    }

    public function edit(Brand $brand_section)
    {
        $brand = $brand_section;

        return view('admin.sections.brand.edit', compact('brand'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'url' => ['required', 'url'],
            'status' => ['required', 'boolean'],
        ]);

        $brand = Brand::findOrFail($id);
        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'));
            $brand->image = $imagePath;
        }
        $brand->url = $request->url;
        $brand->status = $request->status;
        $brand->save();

        Cache::forget('homepage_brands');
        notyf()->success('Updated Successfully!');

        return redirect()->route('admin.brand-section.index');
    }

    public function destroy(Brand $brand_section)
    {
        try {
            // throw ValidationException::withMessages(['you have error']);
            $this->deleteFile($brand_section->image);
            $brand_section->delete();
            Cache::forget('homepage_brands');
            notyf()->success('Delete Succesfully!');

            return response(['message' => 'Delete Successfully!'], 200);
        } catch (\Exception $e) {
            logger('Error >> ' . $e);

            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
