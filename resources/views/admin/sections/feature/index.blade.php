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
                                <h4 class="card-title">Create Level</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.feature.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <x-image-preview src="{{ asset($feature->image_one) }}" style="background-color: rgb(197, 197, 197)"/>
                                                <label for="form-label">Image One</label>
                                                <input type="file" class="form-control" name="image_one" placeholder="">
                                                <input type="hidden" name="old_image_one" value="{{ $feature->image_one }}">
                                                <x-input-error :messages="$errors->get('image_one')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                 <x-image-preview src="{{ asset($feature->image_two) }}" style="background-color: rgb(197, 197, 197)"/>
                                                <label for="form-label">Title One</label>
                                                <input type="text" class="form-control" name="title_one" placeholder=""
                                                    value="{{ $feature->title_one }}">
                                                <x-input-error :messages="$errors->get('title_one')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Subtitle One</label>
                                                <input type="text" class="form-control" name="subtitle_one" placeholder=""
                                                    value="{{ $feature->subtitle_one }}">
                                                <x-input-error :messages="$errors->get('subtitle_one')" class="mt-2" />
                                            </div>
                                        </div>

                                        <br>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <x-image-preview src="{{ asset($feature->image_two) }}"style="background-color: rgb(197, 197, 197)" />
                                                <label for="form-label">Image Two</label>
                                                <input type="file" class="form-control" name="image_two" placeholder="">
                                                <input type="hidden" name="old_image_two" value="{{ $feature->image_two }}">
                                                <x-input-error :messages="$errors->get('image_two')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Title Two</label>
                                                <input type="text" class="form-control" name="title_two" placeholder=""
                                                    value="{{ $feature->title_two }}">
                                                <x-input-error :messages="$errors->get('title_two')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Subtitle Two</label>
                                                <input type="text" class="form-control" name="subtitle_two" placeholder=""
                                                    value="{{ $feature->subtitle_two }}">
                                                <x-input-error :messages="$errors->get('subtitle_two')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <x-image-preview src="{{ asset($feature->image_three) }}" style="background-color: rgb(197, 197, 197)"/>
                                                <label for="form-label">Image Three</label>
                                                <input type="file" class="form-control" name="image_three" placeholder="">
                                                <input type="hidden" name="old_image_three" value="{{ $feature->image_three }}">
                                                <x-input-error :messages="$errors->get('image_three')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Title Three</label>
                                                <input type="text" class="form-control" name="title_three" placeholder=""
                                                    value="{{ $feature->title_three }}">
                                                <x-input-error :messages="$errors->get('title_three')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Subtitle Three</label>
                                                <input type="text" class="form-control" name="subtitle_three" placeholder=""
                                                    value="{{ $feature->subtitle_three }}">
                                                <x-input-error :messages="$errors->get('subtitle_three')" class="mt-2" />
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
