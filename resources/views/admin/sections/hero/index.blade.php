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
                                <h4 class="card-title">Hero</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Label</label>
                                                <input type="text" class="form-control" name="label" placeholder="" value="{{ $hero?->label }}">
                                                <x-input-error :messages="$errors->get('label')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" placeholder="" value="{{ $hero?->title }}">
                                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Subtitle</label>
                                                <input type="text" class="form-control" name="subtitle" placeholder="" value="{{ $hero?->subtitle }}">
                                                <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Button Text</label>
                                                <input type="text" class="form-control" name="button_text" placeholder="" value="{{ $hero?->button_text }}">
                                                <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Button Url</label>
                                                <input type="text" class="form-control" name="button_url" placeholder="" value="{{ $hero?->button_url }}">
                                                <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Video Button Text</label>
                                                <input type="text" class="form-control" name="video_button_text" placeholder="" value="{{ $hero?->video_button_text }}">
                                                <x-input-error :messages="$errors->get('video_button_text')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Video Button Url</label>
                                                <input type="text" class="form-control" name="video_button_url" placeholder="" value="{{ $hero?->video_button_url }}">
                                                <x-input-error :messages="$errors->get('video_button_url')" class="mt-2" />
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Banner Item Title</label>
                                                <input type="text" class="form-control" name="banner_item_title" placeholder="" value="{{ $hero?->banner_item_title }}">
                                                <x-input-error :messages="$errors->get('banner_item_title')" class="mt-2" />
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Banner Item Subtitle</label>
                                                <input type="text" class="form-control" name="banner_item_subtitle" placeholder="" value="{{ $hero?->banner_item_subtitle }}">
                                                <x-input-error :messages="$errors->get('banner_item_subtitle')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Round Text</label>
                                                <input type="text" class="form-control" name="round_text" placeholder="" value="{{ $hero?->round_text }}">
                                                <x-input-error :messages="$errors->get('round_text')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <x-image-preview src="{{ asset($hero?->image) }}"/>
                                                <label for="form-label">Hero Image</label>
                                                <input type="file" class="form-control" name="image" placeholder="">
                                                 <input type="hidden" name="old_image" value="{{ $hero?->image }}">
                                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
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
