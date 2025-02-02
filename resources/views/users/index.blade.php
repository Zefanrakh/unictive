@extends('layouts.app')

@section('content')
    <div class="table-container">
        <h1 class="page-title">Users</h1>
        <a href="{{ route('users.create') }}" class="btn-create">Create User</a>

        <table class="user-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $user)
                    <tr onclick="window.location='{{ route('users.show', $user->id) }}'" class="table-row">
                        <td>{{ $user->name }}
                            @if (auth()->user()->id == $user->id)
                                <span style="color: blue"> - It's You</span>
                            @endif
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst(strtolower($user->role ?? '')) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        @if (!empty($links))
            <nav class="pagination-container">
                <div class="pagination">
                    <div class="page-item {{ $links->prev ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $links->prev ?? '#' }}">Previous</a>
                    </div>
                    @for ($i = 1; $i <= $meta->last_page; $i++)
                        <div class="page-item {{ $meta->current_page == $i ? 'active' : '' }}">
                            <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                        </div>
                    @endfor
                    <div class="page-item {{ $links->next ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $links->next ?? '#' }}">Next</a>
                    </div>
                    </ul>
            </nav>
        @endif
    </div>
@endsection
