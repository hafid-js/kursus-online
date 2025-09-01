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
                'discount' => $item->course->discount ?? '0%',
                'quantity' => $item->quantity ?? 1,
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
                                <a href="#" onclick="alert('sorry, this payment under maintenance')" class="payment_mathod">
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
                            <li>Subtotal :<span>Rp.{{ number_format(cartTotal(), 2) }}</span></li>
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

                const formatRupiah = val => new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(val);

                const name = $(this).data('name');
                const email = $(this).data('email');
                const userId = $(this).data('id');
                const rawItems = $(this).data('items');
                const totalDiscount = {{ cartTotalDiscount() ?? 0 }};
                const totalDiscountFormatted = formatRupiah(totalDiscount);

                const items = typeof rawItems === 'string' ? JSON.parse(rawItems) : rawItems;

                let total = 0;
                let originalTotal = 0;
                let tableRows = '';

                items.forEach((item, index) => {
                    const quantity = item.quantity ?? 1;
                    const discountPercent = parseFloat(item.discount) || 0;
                    const originalPriceTotal = item.price * quantity;
                    const discountAmount = (discountPercent / 100) * originalPriceTotal;
                    const itemTotal = originalPriceTotal - discountAmount;

                    originalTotal += originalPriceTotal;
                    total += itemTotal;

                    tableRows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.title}</td>
                        <td>${formatRupiah(item.price)}</td>
                        <td>${item.discount}%</td>
                        <td>${formatRupiah(itemTotal)}</td>
                    </tr>
                `;
                });

                const totalFormatted = formatRupiah(total);
                const subtotalFormatted = formatRupiah(originalTotal);

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

                <div style="display: flex; flex-direction: column; align-items: flex-end; font-weight: bold; margin-top: 1rem; gap: 0.4rem;">
                    <div class="text-dark" style="font-size: 1rem;">
                        Subtotal: <span style="color: black;">${subtotalFormatted}</span>
                    </div>
                    <div class="text-dark" style="font-size: 1rem;">
                        Discount: <span style="color: red;"><del>${totalDiscountFormatted}</del></span>
                    </div>
                    <div class="text-primary" style="font-size: 1.2rem;">
                        Total: <span style="color: black;">${totalFormatted}</span>
                    </div>
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
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Thank you for your order!',
                                                        text: 'Happy learning and enjoy your new course(s)!',
                                                        showConfirmButton: false,
                                                        timer: 5000,
                                                        timerProgressBar: true
                                                    });

                                                    setTimeout(() => {
                                                        window
                                                            .location
                                                            .href =
                                                            data
                                                            .redirect;
                                                    }, 5000);
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
                                        Swal.fire('Payment Failed',
                                            'There was a problem processing your payment.',
                                            'error');
                                    },
                                    onClose: function() {
                                        console.log(
                                            'User closed the payment popup'
                                        );
                                        Swal.fire('Cancelled',
                                            'You closed the payment window before finishing.',
                                            'info');
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
