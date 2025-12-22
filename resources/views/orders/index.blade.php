@extends('layouts.main')

@section('title', 'My Orders')

@section('content')
<div class="container my-5">

    <div class="card shadow-sm">
        {{-- HEADER --}}
        <div class="card-header text-white d-flex align-items-center"
             style="background:#1f2937">
            <strong>📄 My Orders</strong>
        </div>

        {{-- BODY --}}
        <div class="card-body p-0">
            @if($orders->count())
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#f3f4f6">
                        <tr>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th class="text-end">Total</th>
                            <th>Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="fw-semibold">
                                #{{ $order->order_number }}
                            </td>

                            <td>
                                <span class="badge {{ $order->status_badge }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td>
                                <span class="badge {{ $order->payment_status_badge }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>

                            <td class="text-end fw-semibold">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('orders.show', $order->order_number) }}"
                                   class="btn btn-sm btn-outline-dark">
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="text-center py-5">
                    <p class="text-muted mb-0">You have no orders yet.</p>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
