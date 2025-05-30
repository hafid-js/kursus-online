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
                                <h4 class="card-title">Update Payout Gateway</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.payout-gateway.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                       Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.payout-gateway.update', $payout_gateway->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="form-label">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter level name" value="{{ $payout_gateway->name }}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                                    </div>
                                      <div class="mb-3">
                                        <label for="form-label">Description</label>
                                        <textarea name="description" id="" class="form-control" style="height: 300px">{!! $payout_gateway->description !!}</textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                                    </div>
                                      <div class="mb-3">
                                        <label for="form-label">Status</label>
                                        <select name="status" id="" class="form-select">
                                            <option @selected($payout_gateway->status == 1) value="1">Active</option>
                                            <option @selected($payout_gateway->status == 0) value="0">Inactive</option>
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
