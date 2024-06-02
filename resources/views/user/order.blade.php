@extends('layouts.template3DPrinting')

@section('headTambahan3DPrinting')
<link rel="stylesheet" href="{{ asset('css/dashboard3dPrinting.css') }}">
@endsection

@section('isiInformasi3DPrinting')

@php
    $order = request()->get('order', 'asc');
@endphp

<table border="1">
    <thead>
        <tr>
            <th>
                <a href="{{ request()->fullUrlWithQuery(['order' => ($order == 'asc') ? 'desc' : 'asc']) }}">
                    Tanggal Pesan
                </a>
            </th>
            <th>Jam</th>
            <th>Nama</th>
            <th>Material</th>
            <th>Harga</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tableorderprintuser as $op)
            <tr>
                <td>{{ $op->tanggal_pesan }}</td>
                <td>{{ $op->jam_pesan }}</td>
                <td>{{ $op->nama }}</td>
                <td>{{ $op->material }}</td>
                <td>{{ $op->harga }}</td>
                <td>
                    @if ($op->status == 'waiting')
                        {{ $op->status }}
                    @elseif ($op->status == 'payment')
                        <button type="button" class="pay-now-btn" data-order-id="{{ $op->id_orderprint }}">Pay Now</button>
                    @else
                        {{ $op->status }}
                    @endif
                </td>
            </tr>

            <div id="popup{{ $op->id_orderprint }}" class="popupprint" style="display: none;">
                <div>
                    <h2>Accept Print</h2>
                    <button onclick="closePopup('{{ $op->id_orderprint }}')"><img class="logo"
                            src="{{URL::to('img/x.svg')}}" /></button>
                </div>
                <div>
                    <h4>Kontak (WhatsApp/ Email)</h4>
                    <div>
                        <h4>{{ $op->kontak }}</h4>
                    </div>
                </div>
                <div>
                    <h4>Nama</h4>
                    <div>
                        <h4>{{ $op->nama }}</h4>
                    </div>
                </div>
                <div>
                    <h4>Harga</h4>
                    <div>
                        <h4>{{ $op->harga }}</h4>
                    </div>
                </div>
                <form id="acceptForm" action="{{ route('accept-print', ['id' => $op->id_orderprint]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file_resi" required>
                    <div>
                        <button type="submit">Accept</button>
                    </div>
                </form>

                <form id="declineForm" action="{{ route('decline-order', ['id' => $op->id_orderprint]) }}" method="post">
                    @csrf
                    <button type="submit"
                        onclick="return confirm('Are you sure you want to decline this order?')">Decline</button>
                </form>
            </div>
        @endforeach
    </tbody>
</table>

<script>
    document.querySelectorAll('.pay-now-btn').forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.getAttribute('data-order-id');
            showPopup(orderId);
        });
    });

    function showPopup(orderprintId) {
        var popup = document.getElementById('popup' + orderprintId);
        popup.style.display = 'block';
    }

    function closePopup(orderprintId) {
        var popup = document.getElementById('popup' + orderprintId);
        popup.style.display = 'none';
    }
</script>

@endsection