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
                                <h4 class="card-title">Create Level</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.course-levels.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-header">
                                        <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs"
                                            role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a href="#paypal-setting" class="nav-link active" data-bs-toggle="tab"
                                                    aria-selected="true" role="tab">Paypal Setting</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#stripe-setting" class="nav-link" data-bs-toggle="tab"
                                                    aria-selected="false" role="tab" tabindex="-1">Stripe Setting</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a href="#client-server" class="nav-link" data-bs-toggle="tab"
                                                    aria-selected="false" role="tab" tabindex="-1">Activity</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="paypal-setting" role="tabpanel">
                                                <form action="{{ route('admin.paypal-setting.update') }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="mb-3">
                                                                <label for="form-label">Paypal Mode</label>
                                                                <select name="paypal_mode" class="form-control">
                                                                    <option @selected(config('gateway_settings.paypal_mode') == 'sandbox') value="sandbox">Sandbox</option>
                                                                    <option @selected(config('gateway_settings.paypal_mode') == 'live') value="live">Live</option>
                                                                </select>
                                                                <x-input-error :messages="$errors->get('paypal_mode')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="mb-3">
                                                                <label for="form-label">Currency</label>
                                                                <select name="paypal_currency"
                                                                    class="form-select select2 col-md-5">
                                                                    @foreach (config('gateway_currencies.paypal_currencies') as $key => $value)
                                                                        <option @selected(config('gateway_settings.paypal_currency') == $value['code']) value="{{ $value['code'] }}">
                                                                            {{ $value['code'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <x-input-error :messages="$errors->get('paypal_currency')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="form-label">Rate (USD)</label>
                                                                <input type="text" class="form-control"
                                                                    name="paypal_rate" placeholder="Enter Paypal Rate" value="{{ config('gateway_settings.paypal_rate') }}">
                                                                <x-input-error :messages="$errors->get('paypal_rate')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="form-label">Client ID</label>
                                                                <input type="text" class="form-control"
                                                                    name="paypal_client_id"
                                                                    placeholder="Enter Paypal Client ID"  value="{{ config('gateway_settings.paypal_client_id') }}">
                                                                <x-input-error :messages="$errors->get('paypal_client_id')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="form-label">Client Secret</label>
                                                                <input type="text" class="form-control"
                                                                    name="paypal_client_secret"
                                                                    placeholder="Enter Paypal Client Secret"  value="{{ config('gateway_settings.paypal_client_secret') }}">
                                                                <x-input-error :messages="$errors->get('paypal_client_secret')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="form-label">App ID</label>
                                                                <input type="text" class="form-control"
                                                                    name="paypal_app_id" placeholder="Enter Paypal App ID"  value="{{ config('gateway_settings.paypal_app_id') }}">
                                                                <x-input-error :messages="$errors->get('paypal_app_id')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="stripe-setting" role="tabpanel">
                                                <form action="{{ route('admin.stripe-setting.update') }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="mb-3">
                                                                <label for="form-label">Stripe Status</label>
                                                                <select name="stripe_status" class="form-control">
                                                                    <option @selected(config('gateway_settings.stripe_status') == 'active') value="active">Active</option>
                                                                    <option @selected(config('gateway_settings.stripe_status') == 'inactive') value="inactive">Inactive</option>
                                                                </select>
                                                                <x-input-error :messages="$errors->get('stripe_status')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="mb-3">
                                                                <label for="form-label">Currency</label>
                                                                <select name="stripe_currency"
                                                                    class="form-select select2 col-md-5">
                                                                    @foreach (config('gateway_currencies.stripe_currencies') as $key => $value)
                                                                        <option @selected(config('gateway_settings.stripe_currency') == $value) value="{{ $value }}">
                                                                            {{ $value}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <x-input-error :messages="$errors->get('stripe_currency')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="form-label">Rate (USD)</label>
                                                                <input type="text" class="form-control"
                                                                    name="stripe_rate" placeholder="Enter Stripe Rate" value="{{ config('gateway_settings.stripe_rate') }}">
                                                                <x-input-error :messages="$errors->get('stripe_rate')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="form-label">Publishable Key</label>
                                                                <input type="text" class="form-control"
                                                                    name="stripe_publishable_key"
                                                                    placeholder="Enter Stripe Publishable Key"  value="{{ config('gateway_settings.stripe_publishable_key') }}">
                                                                <x-input-error :messages="$errors->get('stripe_publishable_key')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="form-label">Client Secret</label>
                                                                <input type="text" class="form-control"
                                                                    name="stripe_secret"
                                                                    placeholder="Enter Stripe Client Secret"  value="{{ config('gateway_settings.stripe_secret') }}">
                                                                <x-input-error :messages="$errors->get('stripe_secret')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="client-server" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="form-label">Client Server</label>
                                                            <input type="text" class="form-control" name="name"
                                                                placeholder="Enter level name">
                                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
