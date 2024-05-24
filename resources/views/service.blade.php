@extends('layouts.templateFooterHeader')
@section('headTambahan')
<link rel="stylesheet" href="css/service.css" />
@endsection

@section('isiInformasi')
<div>
  <br>
  <br>
  <br>
  <div class="text-wrapper-3">OUR<br>SERVICES</div>
</div>
<br>
<br>
<br>
<div class="outer3">
  <button class="outer2">
    <img class="imgService" src="{{ URL::to('img/ROBOTIIKMENGAJAR_SERVICES.png') }}" alt="ROBOTIK MENGAJAR" />
    <div class="text-wrapper-2">ROBOTIK MENGAJAR</div>
    <p class="paragrafService">Jelajahi dunia yang mendebarkan dari Internet of Things (IoT) dengan bimbingan ahli kami,
      dan temukan potensi tak terbatas teknologi melalui layanan Tutor IoT kami.</p>
  </button>
  <button class="outer2">
    <img class="imgService" src="{{ URL::to('img/3DPRINTING_SERVICES.png') }}" alt="3D Printing Services" />
    <div class="text-wrapper-2">3D Printing Services</div>
    <p class="paragrafService">Jelajahi dunia yang mendebarkan dari Internet of Things (IoT) dengan bimbingan ahli kami,
      dan temukan potensi tak terbatas teknologi melalui layanan Tutor IoT kami.</p>
  </button>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
@endsection