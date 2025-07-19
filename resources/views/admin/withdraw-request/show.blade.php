@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Create Payout Gateway</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.withdraw-request.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <tbody>
                                        <tr>
                                            <td>Instructor</td>
                                            <td>
                                                <div>
                                                    {{ $withdraw->instructor->name }}
                                                </div>
                                                <span>{{ $withdraw->instructor->email }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Current Wallet Balance</td>
                                            <td>
                                                <div>
                                                    {{ config('settings.currency_icon') }}{{ $withdraw->instructor->wallet }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Payout Amount</td>
                                            <td>
                                                <div>
                                                    {{ config('settings.currency_icon') }}{{ $withdraw->amount }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                <div>
                                                    @if ($withdraw->status == 'pending')
                                                        <span class="badge bg-yellow text-yellow-fg">Pending</span>
                                                    @elseif($withdraw->status == 'rejected')
                                                        <span class="badge bg-red text-red-fg">Rejected</span>
                                                    @else
                                                        <span class="badge bg-green text-green-fg">Approved</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Action</td>
                                            <td>
                                                <div class="alert alert-danger">After Updating the status,
                                                    you can't revert the status.</div>
                                                <div>
                                                    <form
                                                        action="{{ route('admin.withdraw-request.update', $withdraw->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="form-control">
                                                            <label for="">Status</label>
                                                            <select name="status" id=""
                                                                {{ $withdraw->status != 'pending' ? 'disabled' : '' }}>
                                                                <option @selected($withdraw->status == 'pending') value="pending">Pending
                                                                </option>
                                                                <option @selected($withdraw->status == 'approved') value="approved">
                                                                    Approved</option>
                                                                <option @selected($withdraw->status == 'rejected') value="rejected">
                                                                    Rejected</option>
                                                            </select>
                                                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                                            @if ($withdraw->status !== 'approved')
                                                                <button type="submit" class="btn btn-primary mt-3">
                                                                    Update
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
