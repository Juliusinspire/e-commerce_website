@extends('master')
@section('content')
    <form method="POST" action="login">
        @csrf
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button class="btn btn-primary">Login</button>
    </form>
@endsection
