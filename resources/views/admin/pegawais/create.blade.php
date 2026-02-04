<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-900">Tambah Pegawai</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.pegawais.index') }}" class="text-gray-600 hover:text-gray-900">Kembali</a>
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-900">Dashboard</a>
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-900">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <form action="{{ route('admin.pegawais.store') }}" method="POST">
                    @csrf
                    <div class="px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Pegawai</label>
                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Masukkan nama pegawai" required>
                                @error('nama')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="direktorat" class="block text-sm font-medium text-gray-700">Direktorat</label>
                                <select id="direktorat" name="direktorat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="">Pilih Direktorat</option>
                                    @foreach($direktorats as $dir)
                                        <option value="{{ $dir->nama }}" {{ old('direktorat') == $dir->nama ? 'selected' : '' }}>{{ $dir->nama }}</option>
                                    @endforeach
                                </select>
                                @error('direktorat')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="divisi" class="block text-sm font-medium text-gray-700">Divisi</label>
                                <input type="text" id="divisi" name="divisi" value="{{ old('divisi') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Masukkan nama divisi" required>
                                @error('divisi')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="status_pegawai" class="block text-sm font-medium text-gray-700">Status Pegawai</label>
                                <select id="status_pegawai" name="status_pegawai" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="">Pilih Status</option>
                                    @foreach($statusPegawais as $status)
                                        <option value="{{ $status->nama }}" {{ old('status_pegawai') == $status->nama ? 'selected' : '' }}>{{ $status->nama }}</option>
                                    @endforeach
                                </select>
                                @error('status_pegawai')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="lama_bekerja" class="block text-sm font-medium text-gray-700">Lama Bekerja</label>
                                <select id="lama_bekerja" name="lama_bekerja" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="">Pilih Lama Bekerja</option>
                                    @foreach($lamaBekerjas as $lama)
                                        <option value="{{ $lama->nama }}" {{ old('lama_bekerja') == $lama->nama ? 'selected' : '' }}>{{ $lama->nama }}</option>
                                    @endforeach
                                </select>
                                @error('lama_bekerja')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>