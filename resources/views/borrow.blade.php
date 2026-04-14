@extends('layouts.main')
@section('konten')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-5xl">


        <!-- Header -->
        <div class="p-6 bg-sky-950 text-white text-center rounded-t-lg">
            <h1 class="text-3xl font-bold capitalize">daftar peminjaman buku Anda</h1>
        </div>

        <!-- Content -->
        <div class="overflow-x-auto p-6">
            <table class="min-w-full divide-y divide-gray-200">

                @if (session()->has('success'))
                <div class="mb-5 rounded-lg bg-green-100 px-6 py-5 text-sm text-green-800 border border-green-300" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Table Head -->
                <thead class="bg-sky-900 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Nama peminjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">judul buku</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">tanggal peminjaman</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">batas peminjaman</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Action</th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="bg-white divide-y divide-gray-200">


                    @if ($borrows->count())

                    @foreach($borrows as $borrow)
                    <!-- Row 1 -->
                    <tr>
                        <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm capitalize">{{ $borrow->user->name }}</td>
                        <td class="px-6 py-4 text-sm capitalize">{{ $borrow->book->name }}</td>
                        <td class="px-6 py-4 text-sm">{{ $borrow->borrowed_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm">{{ $borrow->due_date->format('d M Y') }}</td>
                        <td class="px-6 py-4">

                            @if ($borrow->status == "diajukan")
                            <span class="px-2 text-xs font-semibold rounded-full capitalize bg-yellow-100 text-yellow-800">{{ $borrow->status }}</span>
                            @elseif ($borrow->status == "dipinjam")
                            <span class="px-2 text-xs font-semibold rounded-full capitalize bg-green-100 text-green-800">{{ $borrow->status }}</span>
                            @elseif ($borrow->status == "dikembalikan")
                            <span class="px-2 text-xs font-semibold rounded-full capitalize bg-blue-100 text-blue-800">{{ $borrow->status }}</span>
                            @elseif ($borrow->status == "ditolak")
                            <span class="px-2 text-xs font-semibold rounded-full capitalize bg-red-100 text-red-800">{{ $borrow->status }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="/borrow/detail/{{ $borrow->id }}" class="bg-blue-200 px-2 py-1 rounded-lg text-blue-500 hover:bg-blue-500 hover:text-white">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data peminjaman buku.</td>
                    </tr>
                    @endif


                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $borrows->links() }}
            </div>
        </div>
    </div>
</div>
</div>
@endsection