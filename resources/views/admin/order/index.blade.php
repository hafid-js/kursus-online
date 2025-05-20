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
                                <h4 class="card-title">Orders</h4>
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
                                                                <th>No.</th>
                                                                <th>Name</th>
                                                                <th>Amount</th>
                                                                <th>Paid Amount</th>
                                                                <th>Currency</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                                {{-- <th class="w-1"></th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($orders as $order)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>
                                                                        <div>
                                                                            {{ $order->customer->name }}
                                                                        </div>
                                                                        <small>{{ $order->customer->email }}</small>
                                                                    </td>
                                                                    <td>{{ $order->total_amount }}</td>
                                                                    <td>{{ $order->paid_amount }}</td>
                                                                    <td>{{ $order->currency }}</td>
                                                                    <td>
                                                                        @if ($order->status == 'pending')
                                                                            <span
                                                                                class="badge bg-yellow text-yellow-fg">{{ $order->status }}</span>
                                                                        @else
                                                                            <span
                                                                                class="badge bg-green text-green-fg">{{ $order->status }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-sm btn-primary">
                                                                            <i class="ti ti-eye"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="3" class="text-center">No Data Found!
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        {{ $orders->links() }}
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
