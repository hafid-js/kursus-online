@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="https://httpbin.org/post" method="post" class="card">
                            <div class="card-header">
                                <h4 class="card-title">Withdraw Requests</h4>
                            </div>
                            <div class="page-body">
                                <div class="container-xl">
                                    <div class="row row-cards">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <table class="table table-vcenter card-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Instructor</th>
                                                                <th>Payout Amount</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                                {{-- <th class="w-1"></th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($withdraws as $withdraw)
                                                                <tr>
                                                                    <td>{{ $withdraw->instructor->name }}</td>
                                                                    <td>{{ config('settings.currency_icon') }}{{ $withdraw->amount }}</td>
                                                                    <td>
                                                                        @if ($withdraw->status == 'pending')
                                                                            <span
                                                                                class="badge bg-yellow text-yellow-fg">Pending</span>
                                                                        @elseif($withdraw->status == 'rejected')
                                                                            <span
                                                                                class="badge bg-red text-red-fg">Rejected</span>
                                                                        @else
                                                                            <span
                                                                                class="badge bg-green text-green-fg">Approved</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('admin.withdraw-request.show', $withdraw->id) }}"
                                                                            class="text-blue"><i class="ti ti-eye"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5" class="text-center">No Data Found!
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        {{ $withdraws->links() }}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
