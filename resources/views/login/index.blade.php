@extends('layouts.templateFooterHeader')
@section('headTambahan')
<link rel="stylesheet" href="css/login.css" />
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@endsection

@section('isiInformasi')

@if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('success') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if (session()->has('loginError'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session('loginError') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<br>
<br>
<div class="wrapper">
  <form action="/login" method="post">
    @csrf
    <h1>Login</h1>
    <div class="input-box">
      <input type="email" name="email" id="email" placeholder="Email" autofocus class="@error('email') is-invalid @enderror" required>
      <i class='bx bxs-user'></i>
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="input-box">
      <input type="password" name="password" id="password" placeholder="Password" required>
      <i class='bx bxs-lock-alt'></i>
    </div>
    <div class="remember-forgot">
      <label><input type="checkbox">Remember Me</label>
      <a href="#">Forgot Password</a>
    </div>
    <button type="submit" class="btn">Login</button>
    <div class="register-link">
      <p>Dont have an account? <a href="/register">Register</a></p>
    </div>
  </form>
</div>
<br>
<br>
<br>
<br>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const alert = document.querySelector('.alert');
    if (alert) {
      setTimeout(function () {
        alert.classList.add('fade-out');
        alert.addEventListener('animationend', function () {
          alert.remove();
        });
      }, 2000); // 3000 milliseconds = 3 seconds
    }
  });
</script>
@endsection
