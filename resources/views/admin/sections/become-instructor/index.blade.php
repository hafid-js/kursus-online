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
                                <h4 class="card-title">Feature</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.become-instructor-section.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <x-image-preview src="{{ asset($becomeInstructor?->image) }}" style="background-color: rgb(197, 197, 197)"/>
                                                <label for="form-label">Image</label>
                                                <input type="file" class="form-control" name="image" placeholder="">
                                                <input type="hidden" name="old_image" value="{{ $becomeInstructor?->image }}">
                                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Title One</label>
                                                <input type="text" class="form-control" name="title" placeholder=""
                                                    value="{{ $becomeInstructor?->title }}">
                                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Subtitle</label>
                                                <input type="text" class="form-control" name="subtitle" placeholder=""
                                                    value="{{ $becomeInstructor?->subtitle }}">
                                                <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                                            </div>
                                        </div>

                                           <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Button Text</label>
                                                <input type="text" class="form-control" name="button_text" placeholder=""
                                                    value="{{ $becomeInstructor?->button_text }}">
                                                <x-input-error :messages="$errors->get('button_text')" class="mt-2" />
                                            </div>
                                        </div>

                                           <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Button URL</label>
                                                <input type="text" class="form-control" name="button_url" placeholder=""
                                                    value="{{ $becomeInstructor?->button_url }}">
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
