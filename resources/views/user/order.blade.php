@extends('layouts.template3DPrinting')

@section('headTambahan3DPrinting')
<link rel="stylesheet" href="{{ asset('css/dashboard3dPrinting.css') }}">
@endsection

@section('isiInformasi3DPrinting')
<form id="selectionForm">
    @csrf
    <label>
        <input type="radio" name="pilihan" value="design">
        DESIGN
    </label>
    <label>
        <input type="radio" name="pilihan" value="print">
        PRINT
    </label>
    <input type="text" id="searchInput" placeholder="Search...">
    <button type="button" onclick="search()">Search</button>
    <i class="bi bi-x"></i>
</form>

<table border="1">
    <tbody>
        @if(isset($tableorderdesignuser))
            <thead>
                <tr>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['order' => ($order == 'asc') ? 'desc' : 'asc']) }}">
                            Tanggal Pesan
                        </a>
                    </th>
                    <th>Jam</th>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Status</th>
                </tr>
            </thead>
            @foreach($tableorderdesignuser as $od)
                <tr>
                    <td>{{ $od->tanggal_pesan }}</td>
                    <td>{{ $od->jam_pesan }}</td>
                    <td>{{ $od->nama }}</td>
                    <td>{{ $od->kontak }}</td>
                    <td>{{ $od->status}}</td>
                </tr>
            @endforeach
        @elseif(isset($tableorderprintuser))
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
                            <button type="submit" onclick="showPopup('{{ $op->id_orderprint }}')">Pay Now</button>
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

        @endif
    </tbody>
</table>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('input[name="pilihan"]').forEach((elem) => {
            elem.addEventListener("change", function (event) {
                let value = event.target.value;
                if (value === 'design') {
                    window.location.href = "{{ route('user.design') }}";
                } else if (value === 'print') {
                    window.location.href = "{{ route('user.print') }}";
                } else {
                    window.location.href = "{{ route('user.design') }}";
                }
            });
        });
    });
    document.querySelectorAll('.pay-now-btn').forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.getAttribute('data-order-id');
            openPopup(orderId);
        });
    });

    // Fungsi untuk menampilkan popup
    function showPopup(orderprintId) {
        var popup = document.getElementById('popup' + orderprintId);
        popup.style.display = 'block';
    }

    // Fungsi untuk menutup popup
    function closePopup(orderprintId) {
        var popup = document.getElementById('popup' + orderprintId);
        popup.style.display = 'none';
    }


</script>

@endsection