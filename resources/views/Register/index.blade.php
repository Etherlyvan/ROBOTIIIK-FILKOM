@extends('layouts.templateFooterHeader')

@section('headTambahan')
<link rel="stylesheet" href="css/login.css" />
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@endsection

@section('isiInformasi')
<br>
<br>
<div class="wrapper lg">
  <form action="/register" method="post">
    @csrf
    <h1>Register</h1>
    <div class="input-box">
      <input type="text" name="name" id="name" placeholder="Name" class="@error('name') is-invalid @enderror" required>
      @error('name')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
    </div>
    <div class="input-box">
      <input type="text" name="username" id="username" placeholder="Username"
        class="@error('username') is-invalid @enderror" required>
      @error('username')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
    </div>
    <div class="input-box">
      <input type="email" name="email" id="email" placeholder="Email" class="@error('email') is-invalid @enderror"
        required>
      @error('email')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
    </div>
    <div class="input-box">
      <input type="password" name="password" id="password" placeholder="Password"
        class="@error('password') is-invalid @enderror" required>
      @error('password')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
    </div>
    <button type="submit" class="btn">Register</button>
    <div class="register-link">
      <p>Have an account? <a href="/login">Login</a></p>
    </div>
  </form>
</div>
<br>
<br>
<br>
<br>
@endsection