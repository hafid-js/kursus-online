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
                                <h4 class="card-title">Orders</h4>
                            </div>
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
                                                        <a data-order-id="{{ $order->id }}"
                                                            class="btn-sm btn-primary show-order">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">No Data Found!
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
        </div>
    </div>

    <!-- Dynamic Modal -->
    <div class="modal fade" id="dynamic-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content dynamic-modal-content">
                <!-- Content injected via AJAX -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            const baseUrl = "{{ url('') }}";

            // Global AJAX CSRF token setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle open Edit Modal
            $('.show-order').on('click', function() {
                const orderId = $(this).data('order-id');
                $('#dynamic-modal').modal('show');
                $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                $.get(`${baseUrl}/admin/orders/${orderId}`, function(html) {
                    $('.dynamic-modal-content').html(html);
                }).fail(() => {
                    $('.dynamic-modal-content').html(
                        '<div class="p-5 text-danger">Error loading form</div>');
                });
            });
        });
    </script>
@endpush
