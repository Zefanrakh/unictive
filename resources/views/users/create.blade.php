@extends('layouts.app')

@section('content')
    <div class="user-container">
        <h1>Create User</h1>
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <x-form-group label="Name" name="name" required />
            <x-form-group label="Email" name="email" required />
            <x-form-group label="Password" name="password" type="password" required />
            <div class="form-group">
                <label>Hobbies</label>
                <div id="hobbies-container">
                </div>
                <button type="button" id="btn-add-hobby" class="btn btn-secondary mt-2">Add Hobby</button>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" class="form-control">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>
@endsection
