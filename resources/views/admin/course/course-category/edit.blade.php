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
                                <h4 class="card-title">Edit Category</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.course-categories.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.course-categories.update', $course_category->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">

                                        <div class="col-md-6">
                                                                                 <x-image-preview class="" src="{{ $course_category->image }}" />
                                            <x-input-file-block name="image" :value="$course_category->image" />
                                                <input type="hidden" name="old_image" value="{{ $course_category->image }}"/>
                                        </div>

                                        <div class="col-md-6">
                                              <x-image-preview class="" src="{{ $course_category->background }}" />
                                            <x-input-file-block name="background" :value="$course_category->background" />
                                                <input type="hidden" name="old_background" value="{{ $course_category->background }}"/>
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-block name="name" :value="$course_category->name"
                                                placeholder="Enter category name" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-input-toggle-block name="show_at_trending" label="Show at Trending"
                                                :checked="$course_category->show_at_trending == 1" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-input-toggle-block name="status" label="Status" :checked="$course_category->status == 1" />
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
