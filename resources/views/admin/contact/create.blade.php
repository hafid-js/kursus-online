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
                                <h4 class="card-title">Create Contact Card</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.contact.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                       Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.contact.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="form-label">Icon</label>
                                        <input type="file" class="form-control" name="icon"
                                            placeholder="">
                                            <x-input-error :messages="$errors->get('icon')" class="mt-2"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="form-label">Title</label>
                                        <input type="text" class="form-control" name="title"
                                            placeholder="">
                                            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                                    </div>
                                     <div class="mb-3">
                                        <label for="form-label">Line One</label>
                                        <input type="text" class="form-control" name="line_one"
                                            placeholder="">
                                            <x-input-error :messages="$errors->get('line_one')" class="mt-2"/>
                                    </div>
                                     <div class="mb-3">
                                        <label for="form-label">Line Two</label>
                                        <input type="text" class="form-control" name="line_two"
                                            placeholder="">
                                            <x-input-error :messages="$errors->get('line_two')" class="mt-2"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="form-label">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                            <x-input-error :messages="$errors->get('status')" class="mt-2"/>
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
