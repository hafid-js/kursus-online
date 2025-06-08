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
                                <h4 class="card-title">Update Category</h4>
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
                                        <x-image-preview class="" src="{{ $course_category->image }}" />
                                        <div class="col-md-6">
                                            <x-input-file-block name="image" :value="$course_category->image" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-block name="icon" :value="$course_category->icon" placeholder="Enter icon name">
                                                <x-slot name="hint">
                                                    <small class="hint">you can get icon classes from: <a target="_blank"
                                                            href="https://tabler.io/icons">https://tabler.io/icons</a></small>
                                                </x-slot>
                                            </x-input-block>
                                        </div>

                                        <div class="col-md-12">
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
                                            <i class="ti ti-device-floppy"></i> Update
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
