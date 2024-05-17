@extends('layouts.app')

@section('title', 'Konfigurasi')

@section('content')
    <style>
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #F7863B;
            color: #fff;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            padding: 20px;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #F7863B;
            border-color: #F7863B;
            border-radius: 5px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #DB6035;
            border-color: #DB6035;
        }

        .alert-danger {
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group {
            width: 100%;
        }

        .form-control {
            width: calc(100% - 20px);
        }

        .or-text {
            margin-top: 20px;
        }
    </style>

    <div class="center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Halaman Konfigurasi</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('checkout') }}" class="form-container">
                        @csrf

                        <div class="form-group">
                            <label for="domain">Domain:</label>
                            <input type="text" id="domain" name="domain" class="form-control" value="{{ $domain }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="duration">Durasi:</label>
                            <select id="duration" name="duration" class="form-control" required>
                                <option value="1">1 Tahun</option>
                                <option value="2">2 Tahun</option>
                                <option value="3">3 Tahun</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="total">Total:</label>
                            <input type="text" id="total" name="total" class="form-control" value="Rp 100.000" readonly>
                        </div>

                        @if ($name && $email)
                            <p>Welcome back,</p>
                            <p>{{ $name }}</p>
                            <p>({{ $email }})!</p>
                        @else
                            <div class="form-group">
                                <label for="name">Nama:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                        @endif

                        @if (!$name && !$email && $errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (!$name && !$email)
                            <p class="or-text">Atau <a href="{{ route('login') }}">login disini</a> jika sudah memiliki akun.</p>
                        @endif

                        <button type="submit" class="btn btn-primary">CHECKOUT</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const durationSelect = document.getElementById('duration');
        const totalInput = document.getElementById('total');

        durationSelect.addEventListener('change', function() {
            const duration = this.value;
            const hargaPerTahun = 100000;
            const total = duration * hargaPerTahun;

            const formattedTotal = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total);
            totalInput.value = formattedTotal;
        });

        const defaultDuration = durationSelect.value;
        const defaultTotal = defaultDuration * 100000;
        const formattedDefaultTotal = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(defaultTotal);
        totalInput.value = formattedDefaultTotal;
    </script>
@endsection
