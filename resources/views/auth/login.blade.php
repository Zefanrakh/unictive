@extends('layouts.app')

@section('content')
    <div class="form-container">
        <h2>Login</h2>
        <form method="POST" action="{{ route('auth.login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <button type="submit">Login</button>
        </form>
        <x-auth-link message="Don't have an account yet?" link="{{ route('auth.register') }}" buttonText="Register" />
    </div>
@endsection
