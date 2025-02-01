@extends('layouts.app')

@section('content')
    <div class="dashboard-container">
        <h1>Welcome to the Dashboard</h1>
        @if (auth()->user() && auth()->user()->role->value === 'user')
            <h2>Your role is {{ auth()->user()->role->value }}. To navigate to other menus, ask the admin or register as an
                admin.
            </h2>
        @endif
        <p>Navigate using the menu above to manage your profile{{ auth()->user() && auth()->user()->role->value === 'admin' ? ' or users' : '' }}.</p>
    </div>
@endsection
