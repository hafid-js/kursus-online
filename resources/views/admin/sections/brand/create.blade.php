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
                                <h4 class="card-title">Brand Section</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.brand-section.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.brand-section.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="mb-3">
                                            <x-image-preview src="" />
                                            <label for="form-label">Image</label>
                                            <input type="file" class="form-control" name="image" placeholder="">
                                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="form-label">URL</label>
                                            <input type="text" class="form-control" name="url"
                                                placeholder="Enter level url">
                                            <x-input-error :messages="$errors->get('url')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="form-label">Status</label>
                                            <select name="status" id="">
                                                <option value="1">Active</option>
                                                 <option value="2">Inactive</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                        </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="ti ti-device-floppy"></i> Create
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
