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
                                <h4 class="card-title">Create Payout Gateway</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.payout-gateway.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                       Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.payout-gateway.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="form-label">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter level name">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="form-label">Description</label>
                                        <textarea name="description" id="" class="form-control" style="height: 300px"></textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                                    </div>
                                      <div class="mb-3">
                                        <label for="form-label">Status</label>
                                        <select name="status" id="" class="form-select">
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
