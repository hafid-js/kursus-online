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
                                <form action="{{ route('admin.contact.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <x-image-preview src="{{ asset($contact->icon) }}"/>
                                        <label for="form-label">Icon</label>
                                        <input type="file" class="form-control" name="icon"
                                            placeholder="">
                                            <input type="hidden" name="old_icon" value="{{ $contact->icon }}">
                                            <x-input-error :messages="$errors->get('icon')" class="mt-2"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="form-label">Title</label>
                                        <input type="text" class="form-control" name="title"
                                            placeholder="" value="{{ $contact->title }}">
                                            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                                    </div>
                                     <div class="mb-3">
                                        <label for="form-label">Line One</label>
                                        <input type="text" class="form-control" name="line_one"
                                            placeholder="" value="{{ $contact->line_one }}">
                                            <x-input-error :messages="$errors->get('line_one')" class="mt-2"/>
                                    </div>
                                     <div class="mb-3">
                                        <label for="form-label">Line Two</label>
                                        <input type="text" class="form-control" name="line_two"
                                            placeholder="" value="{{ $contact->line_two }}">
                                            <x-input-error :messages="$errors->get('line_two')" class="mt-2"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="form-label">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option @selected($contact->status == 1) value="1">Active</option>
                                            <option @selected($contact->status == 0) value="0">Inactive</option>
                                        </select>
                                            <x-input-error :messages="$errors->get('status')" class="mt-2"/>
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
