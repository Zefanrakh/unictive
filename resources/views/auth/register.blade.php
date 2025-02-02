@extends('layouts.app')

@section('content')
    <div class="form-container">
        <h2>Register</h2>
        <form method="POST" action="{{ route('auth.register') }}">
            @csrf
            <x-form-group label="Name" name="name" required />
            <x-form-group label="Email" name="email" required />
            <x-form-group label="Password" name="password" type="password" required />
            <button type="submit">Register</button>
        </form>
        <x-auth-link message="Already have an account?" link="{{ route('auth.login') }}" buttonText="Login" />
    </div>
@endsection
