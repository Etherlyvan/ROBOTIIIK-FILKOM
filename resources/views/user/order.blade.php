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
                    <th>Kontak</th>
                    <th>Status</th>
                </tr>
            </thead>
            @foreach($tableorderprintuser as $op)
                <tr>
                    <td>{{ $op->tanggal_pesan }}</td>
                    <td>{{ $op->jam_pesan }}</td>
                    <td>{{ $op->nama }}</td>
                    <td>{{ $op->material }}</td>
                    <td>{{ $op->kontak }}</td>
                    <td>{{ $op->status}}</td>
                </tr>
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
                }else{
                    window.location.href = "{{ route('user.design') }}";
                }
            });
        });
    });
</script>
@endsection
