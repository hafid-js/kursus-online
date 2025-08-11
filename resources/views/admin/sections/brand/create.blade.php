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
                                            <x-input-file-block name="image"/>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                    </svg> Create
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
