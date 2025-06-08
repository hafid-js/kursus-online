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
                                <h4 class="card-title">About Section</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.about-section.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <x-image-preview src="{{ asset($about->image) }}" style="background-color: rgb(197, 197, 197)"/>
                                                <label for="form-label">Image</label>
                                                <input type="file" class="form-control" name="image" placeholder="">
                                                <input type="hidden" name="old_image" value="{{ $about->image }}">
                                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="form-label">Rounded Text</label>
                                                <input type="text" class="form-control" name="rounded_text" placeholder=""
                                                    value="{{ $about->rounded_text }}">
                                                <x-input-error :messages="$errors->get('rounded_text')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Learner Count</label>
                                                <input type="text" class="form-control" name="learner_count" placeholder=""
                                                    value="{{ $about->learner_count }}">
                                                <x-input-error :messages="$errors->get('learner_count')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Learner Count Text</label>
                                                <input type="text" class="form-control" name="learner_count_text" placeholder=""
                                                    value="{{ $about->learner_count_text }}">
                                                <x-input-error :messages="$errors->get('learner_count_text')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <x-image-preview src="{{ asset($about->learner_image) }}" style="background-color: rgb(197, 197, 197)"/>
                                                <label for="form-label">Learner Image</label>
                                                <input type="file" class="form-control" name="learner_image" placeholder="">
                                                <input type="hidden" name="old_learner_image" value="{{ $about->learner_image }}">
                                                <x-input-error :messages="$errors->get('learner_image')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="form-label">About Title</label>
                                                <input type="text" class="form-control" name="title" placeholder=""
                                                    value="{{ $about->title }}">
                                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="form-label">About Description</label>
                                                  <textarea class="editor" name="description">{!! $about?->description !!}</textarea>
                                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Button Text</label>
                                                <input type="text" class="form-control" name="button_text" placeholder=""
                                                    value="{{ $about->button_text }}">
                                                <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Button Url</label>
                                                <input type="text" class="form-control" name="button_url" placeholder=""
                                                    value="{{ $about->button_url }}">
                                                <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                 <x-image-preview src="{{ $about->video_image }}" style="background-color: rgb(197, 197, 197)"/>
                                                <label for="form-label">Video Image</label>
                                                <input type="file" class="form-control" name="video_image" value="{{ $about->video_image }}">
                                                <x-input-error :messages="$errors->get('video_image')" class="mt-2" />
                                            </div>
                                        </div>
                                         <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="form-label">Video Url</label>
                                                <input type="text" class="form-control" name="video_url" placeholder=""
                                                    value="{{ $about->video_url }}">
                                                <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
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
