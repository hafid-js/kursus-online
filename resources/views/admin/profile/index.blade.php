@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="card-title">Profile Update</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Image</label>
                                                <x-image-preview src="{{ asset($admin->image) }}"/>
                                                <input type="file" class="form-control" name="image" placeholder="">
                                                <input type="hidden" name="old_image" id="" value="{{ $admin->image }}">
                                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="" value="{{ $admin->name }}">
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" placeholder="" value="{{ $admin->email }}">
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Bio</label>
                                                <textarea class="form-control" name="bio" placeholder="">{!! $admin->bio !!}</textarea>
                                                <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="ti ti-device-floppy"></i> Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Password Update</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.password.update') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Current Password</label>
                                                <input type="password" class="form-control" name="current_password" placeholder="" value="">
                                                <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Password</label>
                                                <input type="text" class="form-control" name="password" placeholder="" value="">
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Confirm Password</label>
                                                <input type="text" class="form-control" name="password_confirmation" placeholder="" value="">
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                            </div>
                                        </div>
                                        </div>
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
