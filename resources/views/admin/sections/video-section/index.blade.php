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
                                <h4 class="card-title">Video Section</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.video-section.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <x-image-preview src="{{ asset($video?->background) }}" style="background-color: rgb(197, 197, 197)"/>
                                                <label for="form-label">Background</label>
                                                <input type="file" class="form-control" name="background" placeholder="">
                                                <input type="hidden" name="old_background" value="{{ $video?->background }}">
                                                <x-input-error :messages="$errors->get('background')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="form-label">Video URL</label>
                                                <input type="text" class="form-control" name="video_url" placeholder=""
                                                    value="{{ $video?->video_url }}">
                                                <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                                            </div>
                                        </div>
                                          <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="form-label">Description</label>
                                                <textarea name="description" class="form-control" id="">{!! $video?->description !!}</textarea>
                                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                            </div>
                                        </div>

                                           <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Button Text</label>
                                                <input type="text" class="form-control" name="button_text" placeholder=""
                                                    value="{{ $video?->button_text }}">
                                                <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                                            </div>
                                        </div>
                                           <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Button URL</label>
                                                <input type="text" class="form-control" name="button_url" placeholder=""
                                                    value="{{ $video?->button_url }}">
                                                <x-input-error :messages="$errors->get('button_url')" class="mt-2" />
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
