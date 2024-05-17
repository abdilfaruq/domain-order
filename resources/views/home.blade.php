@extends('layouts.app')

@section('title', 'Halaman Utama')

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

        .input-group {
            width: 100%;
        }

        .input-group-append .btn {
            border-radius: 0 5px 5px 0;
        }

        .btn-primary {
            background-color: #F7863B;
            border-color: #F7863B;
            border-radius: 5px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
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

        .available-message {
            text-align: center;
            margin-bottom: 10px;
        }

        .button-container {
            display: flex;
            justify-content: center;
        }

        .button-container button {
            margin: 0 10px;
        }
    </style>

    <div class="center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Selamat Datang di Qwords</div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('domain_available'))
                        <div class="available-message">
                            Selamat, domain <span style="color: #F7863B; font-weight: bold">{{ session('domain_name') }}</span> Anda tersedia!
                        </div>
                        <div class="button-container">
                            <form method="GET" action="{{ route('configure', ['domain' => session('domain_name')]) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">PESAN</button>
                            </form>
                        </div>
                    @else
                        <form method="POST" action="{{ route('search.domain') }}">
                            @csrf

                            <div class="form-group">
                                <label for="domain">Cari domain:</label>
                                <div class="input-group">
                                    <input type="text" id="domain" name="domain" class="form-control" placeholder="Contoh: example.com" required>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">CARI</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
