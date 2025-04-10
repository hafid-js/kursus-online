


<!doctype html>
<!--
 * Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
 * @version 1.0.0-beta20
 * @link https://tabler.io
 * Copyright 2018-2023 The Tabler Authors
 * Copyright 2018-2023 codecalm.net Paweł Kuna
 * Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
 -->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign in - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->
    <link href="{{ asset('admin/assets/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/demo.min.css?1692870487') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="{{ asset('admin/assets/js/demo-theme.min.js?1692870487') }}"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('admin/assets/img/logo.svg') }}" width="110" height="32" alt="Tabler"
                        class="navbar-brand-image">
                </a>
            </div>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <div class="card card-md">
                <div class="card-body">
                    <span>Forgot your password? No problem. Just let us know your email address and we will email you a
                        password reset link that will allow you to choose a new one.</span>
                    <form method="POST" action="{{ route('admin.password.email') }}" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" :value="old('email')"
                                placeholder="your@gmail.com" required autofocus autocomplete="off">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100">Email Password Reset Link</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('admin/assets/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('admin/assets/js/demo.min.js?1692870487') }}" defer></script>
</body>

</html>
