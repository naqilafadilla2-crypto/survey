@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit User</h1>
        <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:underline">← Kembali ke daftar</a>
    </div>

    @if($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5 text-sm">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password <span class="text-xs text-gray-400">(biarkan kosong untuk tidak mengubah)</span></label>
                <input type="password" name="password"
                       class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih role</option>
                    <option value="admin" {{ old('role', $user->role)=='admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role', $user->role)=='user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 border rounded-md text-sm text-gray-700 hover:bg-gray-50">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded-md hover:bg-blue-800">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection
