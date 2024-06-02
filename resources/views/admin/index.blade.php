@extends('layouts.template3DPrinting')

@section('headTambahan3DPrinting')
<link rel="stylesheet" href="{{ asset('css/dashboard3dPrinting.css') }}">
@endsection

@section('isiInformasi3DPrinting')

<form method="GET" action="{{ route('search') }}">
    <input type="text" name="search" placeholder="Cari Nama atau Kontak" value="{{ request()->get('search') }}">
    <button type="submit">Cari</button>
</form>

<table border="1">
    <tbody>
        @if(isset($tableorderprint))
            <thead>
                <tr>
                    <th>
                        <a
                            href="{{ request()->fullUrlWithQuery(['date_order' => ($dateOrder ?? 'asc') == 'asc' && $statusOrder !== 'desc' ? 'desc' : 'asc', 'status_order' => $statusOrder]) }}">
                            Tanggal Pesan
                        </a>

                    </th>
                    <th>Jam</th>
                    <th>Nama</th>
                    <th>Material</th>
                    <th>Kontak</th>
                    <th>
                        <a
                            href="{{ request()->fullUrlWithQuery(['status_order' => ($statusOrder == 'asc') ? 'desc' : 'asc', 'date_order' => $dateOrder ?? null]) }}">
                            Status
                        </a>
                    </th>
                </tr>
            </thead>

            @foreach($tableorderprint as $op)
                <tr>
                    <td>{{ $op->tanggal_pesan }}</td>
                    <td>{{ $op->jam_pesan }}</td>
                    <td>{{ $op->nama }}</td>
                    <td>{{ $op->material }}</td>
                    <td>{{ $op->kontak }}</td>
                    @if ($op->status == 'waiting')
                        <td><button onclick="showPopup('viewOrder{{ $op->id_orderprint }}')">View order</button></td>
                    @elseif($op->status == 'checking')
                        <td><button onclick="showPopup('checkPayment{{ $op->id_orderprint }}')">Check Payment</button></td>
                    @elseif($op->status == 'processing')
                        <td>
                            <form action="{{ url('/doneprinting/' . $op->id_orderprint) }}" method="post">
                                @csrf
                                <button type="submit">Done Printed</button>
                            </form>
                        </td>
                    @elseif($op->status == 'ready to take')
                        <td>
                            <form action="{{ url('/finishorder/' . $op->id_orderprint) }}" method="post">
                                @csrf
                                <button type="submit">Finish Order</button>
                            </form>
                        </td>
                    @else
                        <td>{{ $op->status }}</td>
                    @endif
                </tr>

                <!-- Popup for View Order -->
                <div class="popupprintadmin" id="viewOrder{{ $op->id_orderprint }}" style="display: none;">
                    <div>
                        <h2>Accept Design</h2>
                        <button onclick="closePopup('viewOrder{{ $op->id_orderprint }}')"><img class="logo"
                                src="{{ asset('img/x.svg') }}" /></button>
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
                    <form id="acceptForm" action="{{ route('accept-print-admin', ['id' => $op->id_orderprint]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <h4>Harga</h4>
                            <input type="text" name="harga" required>
                        </div>
                        <div class="downloadFile">
                            <a href="{{ asset($op->file_name) }}" download>{{ $op->file_name }}</a>
                        </div>
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

                <!-- Popup for Check Payment -->
                <div class="popupcheckpayment" id="checkPayment{{ $op->id_orderprint }}" style="display: none;">
                    <div>
                        <h2>Check Payment</h2>
                        <button onclick="closePopup('checkPayment{{ $op->id_orderprint }}')"><img class="logo"
                                src="{{ asset('img/x.svg') }}" /></button>
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
                    <form id="acceptForm" action="{{ route('accept-payment-admin', ['id' => $op->id_orderprint]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <h4>Harga</h4>
                            <div>
                                <h4>{{ $op->harga }}</h4>
                            </div>
                        </div>
                        <div class="downloadFile">
                            <a href="{{ asset($op->file_name) }}" download>{{ $op->file_name }}</a>
                            <a href="{{ asset($op->file_resi) }}" download>{{ $op->file_resi }}</a>
                        </div>
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
        @endif
    </tbody>
</table>

<script>
    function showPopup(id) {
        var popup = document.getElementById(id);
        popup.style.display = "block";
    }

    function closePopup(id) {
        var popup = document.getElementById(id);
        popup.style.display = "none";
    }
</script>
@endsection