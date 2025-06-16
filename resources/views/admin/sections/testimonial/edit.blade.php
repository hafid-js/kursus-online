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
                                <h4 class="card-title">Create Testimonial</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.testimonial-section.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                       Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.testimonial-section.update', $testimonial_section->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="form-label">Rating</label>
                                        <select name="rating" class="form-control" id="">
                                            @for($i = 5; $i >= 1; $i--)
                                    <option @selected($testimonial_section->rating == $i) value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                        </select>
                                            <x-input-error :messages="$errors->get('rating')" class="mt-2"/>
                                    </div>
                                    <div class="mb-3">

                                        <label for="form-label">Review</label>
                                        <textarea name="review" id="" class="form-control">{{ $testimonial_section->review }}</textarea>
                                            <x-input-error :messages="$errors->get('review')" class="mt-2"/>
                                    </div>
                                    <div class="mb-3">
                                        <x-image-preview src="{{ asset($testimonial_section->user_image) }}"/>
                                        <label for="form-label">Image</label>
                                        <input type="file" class="form-control" name="image" id="">
                                        <input type="hidden" name="old_image" value="{{ $testimonial_section->user_image }}">
                                            <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="form-label">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="" value="{{ $testimonial_section->user_name }}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="form-label">Title</label>
                                        <input type="text" class="form-control" name="title"
                                            placeholder="" value="{{ $testimonial_section->user_title }}">
                                            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
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
