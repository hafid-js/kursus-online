@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Content</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <x-input-block name="title" placeholder="Enter title" :value="$blog->title" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-image-preview src="{{ asset($blog->image) }}"/>
                                            <x-input-file-block name="image"/>
                                            <input type="hidden" name="old_image" value="{{ $blog->image }}">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                     <label for="">Category</label>
                                                <select name="category" id="" class="form-control mt-2">
                                                    <option value="">Select</option>
                                                    @foreach ($categories as $category)
                                                        <option @selected($blog->blog_category_id == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('category')" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                           <div class="form-group mt-3">
                                            <label for="" class="mb-2">Description</label>
                                            <textarea name="description" class="editor" id="">{!! $blog->description !!}</textarea>
                                               <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                                           </div>
                                        </div>
                                        <div class="col-md-3 mt-2">
                                            <x-input-toggle-block name="status" label="Status" :checked="$blog->status == 1" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                    </svg> Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
