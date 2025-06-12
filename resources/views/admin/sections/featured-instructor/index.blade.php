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
                                <h4 class="card-title">Featured Instructor</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.featured-instructor-section.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" placeholder=""
                                                    value="">
                                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="form-label">Subtitle</label>
                                                <textarea name="subtitle" id="" class="form-control"></textarea>
                                                <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Button Text</label>
                                                <input type="text" class="form-control" name="button_text" placeholder=""
                                                    value="">
                                                <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Button URL</label>
                                                <input type="text" class="form-control" name="button_url" placeholder=""
                                                    value="">
                                                <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
                                            </div>
                                        </div>
                                          <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Instructor</label>
                                                <select name="instructor" class="select2"  data-select2-id="select2-data-2-ygmp" tabindex="-1" aria-hidden="true">
                                                    <option value="">Select</option>
                                                    @foreach ($instructors as $instructor)
                                                        <option value="">{{ $instructor->name }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('instructor')" class="mt-2" />
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Courses</label>
                                                <select name="course" class="select2" multiple  data-select2-id="select2-data-3-ygmp" tabindex="-1" aria-hidden="true">
                                                    <option value="">Select</option>
                                                    <option value="">Select1</option>
                                                    <option value="">Select2</option>
                                                </select>
                                                <x-input-error :messages="$errors->get('course')" class="mt-2" />
                                            </div>
                                        </div>
                                         <div class="col-md-12">
                                            <div class="mb-3">
                                                <x-image-preview src=""
                                                    style="background-color: rgb(197, 197, 197)" />
                                                <label for="form-label">Instructor Image</label>
                                                <input type="file" class="form-control" name="instructor_image" placeholder="">
                                                <input type="hidden" name="old_instructor_image" value="">
                                                <x-input-error :messages="$errors->get('instructor_image')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="ti ti-device-floppy"></i> Create
                                            </button>
                                        </div>
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
