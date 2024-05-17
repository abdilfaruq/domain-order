@extends('layouts.app')

@section('title', 'Login')

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

        .form-control {
            width: 100%;
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

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>

    <div class="center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Halaman Login</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login.authenticate') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">LOGIN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
