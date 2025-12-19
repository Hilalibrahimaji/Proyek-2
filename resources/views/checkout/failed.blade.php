@extends('layouts.main')

@section('title', 'Pembayaran Gagal')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-5 text-center">

                    <!-- ICON -->
                    <div class="mb-4">
                        <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center"
                             style="width:90px; height:90px;">
                            <span style="font-size:42px;">❌</span>
                        </div>
                    </div>

                    <!-- TITLE -->
                    <h3 class="fw-bold text-danger mb-2">
                        Pembayaran Gagal
                    </h3>

                    <!-- SUBTITLE -->
                    <p class="text-muted mb-4">
                        Maaf, pembayaran untuk pesanan berikut tidak dapat diproses.
                    </p>

                    <!-- ORDER INFO -->
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <div class="text-muted small">Nomor Pesanan</div>
                        <div class="fw-semibold fs-5">
                            #{{ $order }}
                        </div>
                    </div>

                    <!-- INFO MESSAGE -->
                    <p class="text-muted mb-4">
                        Silakan periksa kembali metode pembayaran Anda  
                        atau coba lakukan pembayaran ulang.
                    </p>

                    <!-- ACTION BUTTONS -->
                    <div class="d-grid gap-2">
                        <a href="{{ url('/checkout/process/'.$order) }}"
                           class="btn btn-warning btn-lg rounded-pill">
                            🔄 Coba Bayar Lagi
                        </a>

                        <a href="{{ url('/') }}"
                           class="btn btn-outline-secondary rounded-pill">
                            ⬅ Kembali ke Beranda
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
