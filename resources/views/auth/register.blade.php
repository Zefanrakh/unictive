@extends('layouts.app')

@section('content')
    <div class="form-container">
        <h2>Register</h2>
        <form method="POST" action="{{ route('auth.register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <x-auth-link message="Already have an account?" link="{{ route('auth.login') }}" buttonText="Login" />
    </div>
@endsection
