<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DomainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function searchDomain(Request $request)
    {
        $domainName = $request->input('domain');

        $response = Http::get('https://portal.qwords.com/apitest/whois.php', [
            'domain' => $domainName
        ]);

        if ($response->successful() && isset($response['status']) && $response['status'] === 'available') {
            $request->session()->flash('domain_available', 'Selamat, domain Anda tersedia!');
            $request->session()->flash('domain_name', $domainName);

            return redirect()->route('home');
        } else {
            return redirect()->route('home')->with('error', 'Maaf, domain tidak tersedia.');
        }
    }

    public function configure(Request $request, $domain)
    {
        $duration = $request->input('duration');

        $email = null;
        $name = null;

        if (Auth::check()) {
            $user = Auth::user();
            $email = $user->email;
            $name = $user->name;
        }

        return view('configure', compact('domain', 'duration', 'email', 'name'));
    }

    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'domain' => 'required|string',
                'duration' => 'required|numeric',
            ], [
                'email.unique' => 'Email sudah terpakai.',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            Auth::login($user);

        } else {
            $user = Auth::user();

            $request->validate([
                'domain' => 'required|string',
                'duration' => 'required|numeric',
            ]);
        }

        return $this->processCheckout($request, $user);
    }

    private function processCheckout(Request $request, User $user)
    {
        $invoice = new Invoice();
        $invoice->user_id = $user->id;
        $invoice->domain = $request->domain;
        $invoice->total = 100000 * $request->duration;
        $invoice->save();

        return redirect()->route('invoice.invoice', ['invoice' => $invoice->id])->with('success', 'Pemesanan berhasil! Silakan cek halaman invoice untuk detail pembayaran.');
    }


    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if ($request->session()->has('domain')) {
                return redirect()->route('configure', ['domain' => $request->session()->get('domain')]);
            } else {
                return redirect()->route('invoice');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email atau password salah.');
        }
    }

    public function invoice(Invoice $invoice)
    {
        $user = auth()->user();
        return view('invoice', compact('invoice', 'user'));
    }
}
