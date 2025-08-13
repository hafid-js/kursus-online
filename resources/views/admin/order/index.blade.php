@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Orders</h4>
                                <input type="text" id="searchInput" class="form-control" placeholder="Search..."
                                        style="width: 200px;">
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
                                                <th>Date</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="orderTableBody">
                                        @include('admin.order.partials.table', [
                                            'orders' => $orders,
                                        ])
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- {{ $orders->links() }} --}}
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

        // ajax search
        function debounce(fn, delay) {
            let timer;
            return function() {
                const context = this;
                const args = arguments;
                clearTimeout(timer);
                timer = setTimeout(() => fn.apply(context, args), delay);
            };
        }

        document.addEventListener('DOMContentLoaded', function() {
            initLiveSearch({
                inputSelector: '#searchInput',
                resultSelector: '#orderTableBody',
                url: "{{ route('admin.orders.index') }}"
            });
        });
    </script>
@endpush
