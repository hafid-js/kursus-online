@extends('admin.setting.layout')
@section('setting-content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <form action="{{ route('admin.commision-settings.update') }}" method="POST">
            @csrf
            <div class="card-body">
                <h3 class="card-title mt-4">Commision Settings</h3>
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="form-label">Instructor Commision Rate Per Sale (%)</div>
                        <input type="text" class="form-control" name="commission_rate"
                            value="{{ config('settings.commission_rate') }}">
                        <x-input-error :messages="$errors->get('commission_rate')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent mt-auto">
                <div class="btn-list justify-content-end">
                    <a href="#" class="btn btn-1"> Cancel </a>
                    <button type="submit" class="btn btn-primary btn-2"> Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
