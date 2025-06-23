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
                                <h4 class="card-title">Top Bar</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.top-bar.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" placeholder="" value="{{ $topbar->email }}">
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" placeholder="" value="{{ $topbar->phone }}"">
                                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Offer Name</label>
                                                <input type="text" class="form-control" name="offer_name" placeholder="" value="{{ $topbar->offer_name }}">
                                                <x-input-error :messages="$errors->get('offer_name')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Short Description</label>
                                                <input type="text" class="form-control" name="offer_short_description" placeholder="" value="{{ $topbar->offer_short_description }}">
                                                <x-input-error :messages="$errors->get('offer_short_description')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Button Text</label>
                                                <input type="text" class="form-control" name="offer_button_text" placeholder="" value="{{ $topbar->offer_short_text }}">
                                                <x-input-error :messages="$errors->get('offer_button_text')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Button Url</label>
                                                <input type="text" class="form-control" name="offer_button_url" placeholder="" value="{{ $topbar->offer_button_url }}">
                                                <x-input-error :messages="$errors->get('offer_button_url')" class="mt-2" />
                                            </div>
                                        </div>
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
