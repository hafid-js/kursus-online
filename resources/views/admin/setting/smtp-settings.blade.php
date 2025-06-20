@extends('admin.setting.layout')
@section('setting-content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <form action="{{ route('admin.smtp-settings.update') }}" method="POST">
            @csrf
            <div class="card-body">
                <h3 class="card-title mt-4">SMTP Settings</h3>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-label">Sender Email</div>
                        <input type="text" class="form-control" name="sender_email"
                            value="{{ config('settings.sender_email') }}">
                        <x-input-error :messages="$errors->get('sender_email')" class="mt-2" />
                    </div>
                     <div class="col-md-6">
                        <div class="form-label">Receiver Email</div>
                        <input type="text" class="form-control" name="receiver_email"
                            value="{{ config('setings.receiver_email') }}">
                        <x-input-error :messages="$errors->get('receiver_email')" class="mt-2" />
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
