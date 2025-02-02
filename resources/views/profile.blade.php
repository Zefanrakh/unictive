@extends('layouts.app')

@section('content')
    <div class="user-container">
        @if (!request()->routeIs('users.show'))
            <h1>Hi {{ $user['name'] }}!</h1>
        @else
            <h1>Update {{ $user['name'] }}</h1>
        @endif

        <form method="POST"
            action="{{ request()->routeIs('users.show') ? route('users.update', ['user' => $user['id']]) : route('profile.update') }}">
            @csrf
            <x-form-group label="Name" name="name" :value="$user['name'] ?? ''" />
            <x-form-group label="Email" name="email" :value="$user['email'] ?? ''" />
            @if (!request()->routeIs('users.show'))
                <x-form-group label="Password" name="password" :value="$user['password'] ?? ''" type="password" />
            @endif
            <div class="form-group">
                <label>Hobbies</label>
                <div id="hobbies-container">
                    @if (!empty($user['hobbies']))
                        @foreach ($user['hobbies'] as $hobby)
                            <div class="hobby-item">
                                <input type="text" name="hobbies[]" value="{{ $hobby }}"
                                    class="form-control hobby-field">
                                <button type="button" class="btn-remove-hobby">Remove</button>
                            </div>
                        @endforeach
                    @else
                        <div class="hobby-item">
                            <input type="text" name="hobbies[]" class="form-control hobby-field">
                            <button type="button" class="btn-remove-hobby">Remove</button>
                        </div>
                    @endif
                </div>
                <button type="button" id="btn-add-hobby" class="btn btn-secondary mt-2">Add Hobby</button>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        @if (request()->routeIs('users.show'))
            <form action="{{ route('users.destroy', $user['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        @endif

    </div>
@endsection
