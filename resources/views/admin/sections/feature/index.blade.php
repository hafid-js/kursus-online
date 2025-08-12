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
                                <form action="{{ route('admin.feature.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="col-md-5">
                                                    <x-image-preview src="{{ asset($feature?->image_one) }}"
                                                        style="background-color: rgb(197, 197, 197)" />
                                                    <x-input-file-block name="image_one" />
                                                </div>
                                                <input type="hidden" name="old_image_one"
                                                    value="{{ $feature?->image_one }}">
                                                <x-input-error :messages="$errors->get('image_one')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input-block name="title_one" value="{{ $feature?->title_one }}" />
                                                <x-input-error :messages="$errors->get('title_one')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input-block name="subtitle_one" value="{{ $feature?->subtitle_one }}" />
                                                <x-input-error :messages="$errors->get('subtitle_one')" class="mt-2" />
                                            </div>
                                        </div>

                                        <br>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="col-md-5">
                                                    <x-image-preview src="{{ asset($feature?->image_two) }}"
                                                        style="background-color: rgb(197, 197, 197)" />
                                                    <x-input-file-block name="image_two" />
                                                </div>
                                                <input type="hidden" name="old_image_two"
                                                    value="{{ $feature?->image_two }}">
                                                <x-input-error :messages="$errors->get('image_two')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input-block name="title_two" value="{{ $feature?->title_two }}" />
                                                <x-input-error :messages="$errors->get('title_two')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input-block name="subtitle_two" value="{{ $feature?->subtitle_two }}" />
                                                <x-input-error :messages="$errors->get('subtitle_two')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="col-md-5">
                                                    <x-image-preview src="{{ asset($feature?->image_three) }}"
                                                        style="background-color: rgb(197, 197, 197)" />
                                                    <x-input-file-block name="image_three" />
                                                </div>
                                                <input type="hidden" name="old_image_three"
                                                    value="{{ $feature?->image_three }}">
                                                <x-input-error :messages="$errors->get('image_three')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input-block name="title_three" value="{{ $feature?->title_three }}" />
                                                <x-input-error :messages="$errors->get('title_three')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input-block name="subtitle_three"
                                                    value="{{ $feature?->subtitle_three }}" />
                                                <x-input-error :messages="$errors->get('subtitle_three')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                                </svg> Create
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
