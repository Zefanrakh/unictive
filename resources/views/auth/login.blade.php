@extends('layouts.app')

@section('content')
    <div class="form-container">
        <h2>Login</h2>
        <form method="POST" action="{{ route('auth.login') }}">
            @csrf
            <x-form-group label="Email" name="email" required />
            <x-form-group label="Password" name="password" type="password" required />

            <button type="submit">Login</button>
        </form>
        <x-auth-link message="Don't have an account yet?" link="{{ route('auth.register') }}" buttonText="Register" />
    </div>
@endsection
