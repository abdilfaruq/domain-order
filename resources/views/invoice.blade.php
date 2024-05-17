@extends('layouts.app')

@section('title', 'Invoice')

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

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details h4 {
            color: #333;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .invoice-details p {
            margin-bottom: 5px;
            color: #666;
            font-size: 14px;
        }

        .status-box {
            background-color: #f7f7f7;
            border: 1px solid #eee;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .status-unpaid {
            font-weight: bold;
            color: #f7863b;
            font-size: 16px;
        }

        .table-box {
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .table {
            margin: 0;
            padding: 0;
        }

        .table th,
        .table td {
            border: none;
            padding: 8px 12px;
            vertical-align: middle;
            font-size: 14px;
        }

        .total-amount {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        .payment-instructions {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .payment-instructions strong {
            color: #f7863b;
        }

        .text-muted {
            color: #666 !important;
        }
    </style>

    <div class="center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Halaman Invoice</div>

                <div class="card-body">
                    <div class="invoice-details">
                        <h4>No Invoice: #{{ $invoice->id }}</h4>
                        @if($user)
                            <p>Nama: {{ $user->name }}</p>
                            <p>Email: {{ $user->email }}</p>
                        @else
                            <p>Nama: -</p>
                            <p>Email: -</p>
                        @endif
                    </div>

                    <div class="status-box">
                        <span class="status-unpaid">UNPAID</span>
                    </div>

                    <div class="table-box">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Deskripsi</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Pembelian domain {{ $invoice->domain }}</td>
                                    <td>Rp {{ number_format($invoice->total, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <p class="total-amount">Total: <strong>Rp {{ number_format($invoice->total, 0, ',', '.') }}</strong></p>

                    <p class="payment-instructions">Silahkan bayar di no rekening berikut ini: </p>
                    <p class="payment-instructions"><strong>666123456789</strong></p>
                </div>
            </div>
        </div>
    </div>
@endsection
