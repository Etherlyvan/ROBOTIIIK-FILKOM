@extends('layouts.template3DPrinting')

@section('headTambahan3DPrinting')
<link rel="stylesheet" href="{{ asset('css/dashboard3dPrinting.css') }}">
@endsection

@section('isiInformasi3DPrinting')
<form id="selectionForm">
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
        @if(isset($tableorderdesign))
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
            @foreach($tableorderdesign as $od)
                <tr>
                    <td>{{ $od->tanggal_pesan }}</td>
                    <td>{{ $od->jam_pesan }}</td>
                    <td>{{ $od->nama }}</td>
                    <td>{{ $od->kontak }}</td>
                    <td>
                        <select name="status" onchange="updateStatus('{{ $od->id_orderdesign }}', this.value, 'design')">
                            <option value="{{ $od->status }}" selected>{{ $od->status }}</option>
                            <option value="Done" {{ $od->status == 'Done' ? 'selected' : '' }}>Done</option>
                            <option value="Ditolak" {{ $od->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="DPLunas" {{ $od->status == 'DPLunas' ? 'selected' : '' }}>DPLunas</option>
                            <option value="Proses" {{ $od->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                        </select>
                    </td>
                </tr>
            @endforeach
        @elseif(isset($tableorderprint))
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
            @foreach($tableorderprint as $op)
                <tr>
                    <td>{{ $op->tanggal_pesan }}</td>
                    <td>{{ $op->jam_pesan }}</td>
                    <td>{{ $op->nama }}</td>
                    <td>{{ $op->material }}</td>
                    <td>{{ $op->kontak }}</td>
                    <td>
                        <select name="status" onchange="updateStatus('{{ $op->id_orderprint }}', this.value, 'print')">
                            <option value="{{ $op->status }}" selected>{{ $op->status }}</option>
                            <option value="Done" {{ $op->status == 'Done' ? 'selected' : '' }}>Done</option>
                            <option value="Ditolak" {{ $op->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="DPLunas" {{ $op->status == 'DPLunas' ? 'selected' : '' }}>DPLunas</option>
                            <option value="Proses" {{ $op->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                        </select>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<script>
    function updateStatus(id, status, type) {
        let url = (type === 'design') ? `/update-design-status/${id}` : `/update-print-status/${id}`;

        // Send Ajax request
        fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: status })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to update status');
                }
                // Handle success or update UI as needed
            })
            .catch(error => {
                console.error(error);
                // Handle error or display error message
            });
    }


    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('input[name="pilihan"]').forEach((elem) => {
            elem.addEventListener("change", function (event) {
                let value = event.target.value;
                if (value === 'design') {
                    window.location.href = "/tampilkanorderdesign/ambildatatabeldesign";
                } else if (value === 'print') {
                    window.location.href = "/tampilkanorderprint/ambildatatabelprint";
                }
            });
        });
    });
</script>
@endsection