@extends('frontend.layouts.layout')
@section('content')
    <section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <h1>Checkout</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $items = [];

        foreach ($cart as $item) {
            $items[] = [
                'title' => $item->course->title,
                'price' => $item->course->price,
            ];
        }
    @endphp

    <section class="payment pt_95 xs_pt_75 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="payment_area">
                        <div class="row">
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="" class="payment_mathod confirm-payment" data-id="{{ auth()->id() }}"
                                    data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                    data-items='@json($items)'>
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Midtrans.png"
                                        alt="payment" class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="{{ route('paypal.payment') }}" class="payment_mathod">
                                    <img src="{{ asset('frontend/assets/images/payment_2.png') }}" alt="payment"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="{{ asset('frontend/assets/images/payment_3.png') }}" alt="payment"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="{{ route('stripe.payment') }}" class="payment_mathod">
                                    <img src="{{ asset('frontend/assets/images/payment_4.png') }}" alt="payment"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="{{ asset('frontend/assets/images/payment_4.png') }}" alt="payment"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="{{ asset('frontend/assets/images/payment_5.png') }}" alt="payment"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="{{ asset('frontend/assets/images/payment_6.png') }}" alt="payment"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="{{ asset('frontend/assets/images/payment_7.png') }}" alt="payment"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="{{ asset('frontend/assets/images/payment_8.png') }}" alt="payment"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="{{ asset('frontend/assets/images/payment_1.png') }}" alt="payment"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="{{ asset('frontend/assets/images/payment_2.png') }}" alt="payment"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="{{ asset('frontend/assets/images/payment_3.png') }}" alt="payment"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="total_payment_price">
                        <h4>Total Cart <span>(0{{ cartCount() }})</span></h4>
                        <ul>
                            <li>Subtotal :<span>Rp.{{ cartTotal() }}</span></li>
                        </ul>
                        {{-- <a href="#" class="common_btn">now payment</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        $(function() {
            $(".confirm-payment").on("click", function(e) {
                e.preventDefault();

                const name = $(this).data('name');
                const email = $(this).data('email');
                const userId = $(this).data('id');
                const rawItems = $(this).data('items');

                const items = typeof rawItems === 'string' ? JSON.parse(rawItems) : rawItems;

                let total = 0;
                let tableRows = '';

                const formatRupiah = val => new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR'
}).format(val);


                items.forEach((item, index) => {
                    const quantity = item.quantity ?? 1;
                    const discount = item.discount ?? '0%';
                    const itemTotal = item.price * quantity;
                    total += itemTotal;

                    tableRows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.title}</td>
                        <td>${formatRupiah(item.price)}</td>
                        <td>${discount}</td>
                        <td>${formatRupiah(itemTotal)}</td>
                    </tr>
                `;
                });

                const subtotalFormatted = formatRupiah(total);

                Swal.fire({
                    title: 'Confirm Your Orders',
                    width: 1000,
                    html: `
        <div class="table-responsive">
            <table class="table table-bordered" style="font-size:14px;">
                <thead>
                    <tr style="background:#f2f2f2;">
                        <th>No</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    ${tableRows}
                </tbody>
            </table>
        </div>
        <div style="text-align:right; font-weight:bold; margin-top:1rem;">
            Subtotal: ${subtotalFormatted}
        </div>
    `,
                    showCancelButton: true,
                    confirmButtonText: 'Process',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {

                        // ⏳ Tampilkan loading sebelum proses Midtrans
                        Swal.fire({
                            title: 'Processing...',
                            html: 'Please wait while we prepare your payment...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: '/midtrans/create-transaction',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                user_id: userId,
                                items: JSON.stringify(items),
                                name: name,
                                email: email,
                            },
                            success: function(response) {
                                Swal.close();

                                snap.pay(response.token, {
                                    onSuccess: function(result) {
                                        console.log('Payment successful',
                                            result);

                                        fetch('/order/store', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                },
                                                body: JSON.stringify({
                                                    transaction_id: result
                                                        .transaction_id,
                                                    main_amount: result
                                                        .gross_amount,
                                                    paid_amount: result
                                                        .gross_amount,
                                                    currency: 'IDR'
                                                })
                                            })
                                            .then(res => res.json())
                                            .then(data => {
                                                if (data.success) {
                                                    window.location
                                                        .href =
                                                        "http://127.0.0.1:8000/student/dashboard";
                                                } else {
                                                    Swal.fire('Error',
                                                        'Failed to save order',
                                                        'error');
                                                }
                                            })
                                            .catch(() => {
                                                Swal.fire('Error',
                                                    'An error occurred while saving the order',
                                                    'error');
                                            });
                                    },
                                    onPending: function(result) {
                                        console.log('Payment pending',
                                            result);
                                    },
                                    onError: function(result) {
                                        console.log('Payment error',
                                        result);
                                    },
                                    onClose: function() {
                                        console.log(
                                            'User closed the payment popup'
                                            );
                                    }
                                });
                            },
                            error: function(err) {
                                Swal.close();
                                Swal.fire('Error', 'Failed to create transaction',
                                    'error');
                            }

                        });
                    }
                });

            });
        });
    </script>
@endpush
