@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">User</h1>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 bg-blue-700 text-white px-4 py-2 rounded-md shadow hover:bg-blue-800">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead>
                <tr class="bg-blue-700 text-white">
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Role</th>
                    <th class="px-4 py-3 text-left">Dibuat</th>
                    <th class="px-4 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($users as $user)
                <tr class="odd:bg-white even:bg-gray-50">
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $user->id }}</td>
                    <td class="px-4 py-3 text-sm text-gray-800">{{ $user->name }}</td>
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $user->email }}</td>
                    <td class="px-4 py-3">
                        @if(strtolower($user->role ?? '') === 'admin')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Admin</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">User</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ optional($user->created_at)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3 text-sm">
                        <a href="{{ route('admin.users.edit', $user) }}" class="inline-block bg-green-600 text-white px-3 py-1 rounded-md mr-2 hover:bg-green-700">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus user ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="inline-block bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $users->links() }}</div>
</div>
@endsection
