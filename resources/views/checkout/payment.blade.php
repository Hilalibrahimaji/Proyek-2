@extends('layouts.main')

@section('title', 'Payment')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center">
    <div class="bg-white shadow-xl rounded-xl p-8 max-w-lg w-full text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">
            Pembayaran Pesanan
        </h2>

        <p class="text-gray-500 mb-4">
            Order ID:
            <span class="font-semibold text-indigo-600">
                #{{ $order->order_number }}
            </span>
        </p>

        {{-- RINGKASAN --}}
        <div class="border rounded-lg p-4 mb-6 text-left text-sm text-gray-700">
            <div class="flex justify-between mb-2">
                <span>Subtotal</span>
                <span>Rp {{ number_format($order->subtotal,0,',','.') }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span>Ongkir</span>
                <span>Rp {{ number_format($order->shipping,0,',','.') }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span>Pajak</span>
                <span>Rp {{ number_format($order->tax,0,',','.') }}</span>
            </div>
            <hr class="my-2">
            <div class="flex justify-between font-bold text-lg">
                <span>Total</span>
                <span class="text-green-600">
                    Rp {{ number_format($order->total,0,',','.') }}
                </span>
            </div>
        </div>

        {{-- LOADING --}}
        <div id="loading" class="hidden text-gray-500">
            Membuka pembayaran...
        </div>

        {{-- FALLBACK BUTTON --}}
        <button id="pay-button"
            class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold transition">
            Bayar Sekarang
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.client_key') }}">
</script>

<script>
    function pay() {
        document.getElementById('loading').classList.remove('hidden');

        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function () {
                window.location.href = "{{ route('checkout.success', $order->order_number) }}";
            },
            onPending: function () {
                alert('Menunggu pembayaran...');
            },
            onError: function () {
                window.location.href = "{{ route('checkout.failed', $order->order_number) }}";
            }
        });
    }

    // AUTO OPEN SNAP
    window.onload = function () {
        pay();
    };

    // fallback manual click
    document.getElementById('pay-button').onclick = pay;
</script>
@endpush
