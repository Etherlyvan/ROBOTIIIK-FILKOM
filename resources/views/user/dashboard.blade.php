@extends('layouts.template3DPrinting')

@section('headTambahan3DPrinting')
<link rel="stylesheet" href="{{ asset('css/dashboard3dPrinting.css') }}">
@endsection

@section('isiInformasi3DPrinting')
<div class="palingLuar">
    <div class="outer1">
        <div class="inner1">
            <div class="inti1">
                <h1>ROBOTIIK <br> 3D Printing</h1>
            </div>
            <div class="inti2">
                <form action="/DashBoard/SendDesign" method="post">
                    @csrf
                    <button class="button1" style="background: none; border: none;">Send Design</button>
                </form>
            </div>
        </div>
        <img src="/img/AlatPrinting3D.svg" alt="AlatPrinting3D">
    </div>
    <div class="outer2">
        <div class="inner3">
            <h1>Why 3D Print?</h1>
        </div>
        <div class="inner4">
            <div class="inti3">
                <div class="kotak1">
                    <h2>Reduce Assembly Time</h2>
                </div>
                <p>Don't waste time putting products together! Rely on 3D printing to make complex geometries that
                    can be printed as one piece or consolidated in one build.</p>
            </div>
            <div class="inti3">
                <div class="kotak1">
                    <h2>Reduce Assembly Time</h2>
                </div>
                <p>Working on a project for a customer that has to be just right? Get models back fast, and 3D print
                    new iterations, if needed, for final feedback and production</p>
            </div>
            <div class="inti3">
                <div class="kotak1">
                    <h2>Reduce Assembly Time</h2>
                </div>
                <p>Proprietary processes, expert 3D printing operators, and inspections are our secrets to
                    delivering exceptional, quality products every time.</p>
            </div>
        </div>
    </div>

    <div class="outer2">
        <div class="inner5">
            <h1>Materials We Offer</h1>
        </div>
        <div class="inner6">
            <div class="inti4">
                <div class="kotak2">
                    <h2>PLA</h2>
                </div>
                <p>Material ini merupakan termoplastik biodegradable yang ramah lingkungan karena terbuat dari pati
                    jagung atau gula tebu.</p>
            </div>
            <div class="inti4">
                <div class="kotak2">
                    <h2>ABS</h2>
                </div>
                <p>ABS adalah material murah yang sesuai untuk produk dan bagian-bagian yang kuat dan tahan panas.</p>
            </div>
            <div class="inti4">
                <div class="kotak2">
                    <h2>PET</h2>
                </div>
                <p>PET filamen dikenal karena mudah dicetak, dapat menghasilkan permukaan yang lembut, dan tahan air.
                </p>
            </div>
        </div>
    </div>
</div>

<br>
<br>

@auth
    <form action="orderprint" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="senddesign">
            <h1>Send Design</h1>
            <div>
                <h3>Kontak (WhatsApp/ Email)</h3>
                <input type="text" name="kontak" required>
            </div>
            <div>
                <h3>Nama</h3>
                <input type="text" name="nama" required>
            </div>
            <div>
                <h3>Material</h3>
                <select name="material" id="material" required>
                    <option value="ABS">ABS</option>
                    <option value="PLA">PLA</option>
                    <option value="PET">PET</option>
                </select>
            </div>
            <div>
                <input type="file" name="file_name" required>
            </div>
            <button onclick="submit">Submit</button>
        </div>
    </form>
@endauth

@endsection