@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.contact-setting.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <x-image-preview src="{{ asset($contactSetting->image) }}"/>
                                        <label for="form-label">Image</label>
                                        <input type="file" class="form-control" name="image">
                                            <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="form-label">Map Url</label>
                                        <input type="text" class="form-control" name="map_url"
                                            placeholder="" value="{{ $contactSetting->map_url }}">
                                            <x-input-error :messages="$errors->get('map_url')" class="mt-2"/>
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
