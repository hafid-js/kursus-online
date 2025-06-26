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
                                <h4 class="card-title">Footer Contents</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.footer.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Description</label>
                                                <input type="text" class="form-control" name="description" placeholder=""
                                                    value="{{ $footer?->description }}">
                                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Copyright</label>
                                                <input type="text" class="form-control" name="copyright" placeholder=""
                                                    value="{{ $footer?->copyright }}">
                                                <x-input-error :messages="$errors->get('copyright')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" placeholder=""
                                                    value="{{ $footer?->phone }}">
                                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" placeholder=""
                                                    value="{{ $footer?->email }}">
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" placeholder=""
                                                    value="{{ $footer?->address }}">
                                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
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
