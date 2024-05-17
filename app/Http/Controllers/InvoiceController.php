<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function invoice(Invoice $invoice)
    {
        $user = Auth::user();
        return view('invoice', compact('invoice', 'user'));
    }

}
