    @extends('dashboard.layouts.main')

    @section('kontent')
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 lg:col-span-12 p-4">
        @if (session()->has('success'))
            <div class="mb-5 rounded-lg bg-green-100 px-6 py-5 text-sm text-green-800 border border-green-300" role="alert">
                {{ session('success') }}
            </div>
        @endif
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 lg:col-span-12 p-4">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama Peminjam
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Buku
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Peminjaman
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Deadline
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($borrows->count())
                        @foreach ($borrows as $borrow)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-4">
                                    {{ $borrow->user->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $borrow->book->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $borrow->borrowed_date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $borrow->due_date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 capitalize ">
                                    @if ($borrow->status == "diajukan")
                                        <p class="bg-yellow-600 text-white text-center p-1 rounded w-full">{{ $borrow->status }}</p>
                                    @elseif ($borrow->status == "dipinjam")
                                        <p class="bg-green-600 text-white text-center p-1 rounded w-full">{{ $borrow->status }}</p>
                                    @elseif ($borrow->status == "dikembalikan")
                                        <p class="bg-blue-600 text-white text-center p-1 rounded w-full">{{ $borrow->status }}</p>
                                    @elseif ($borrow->status == "ditolak")
                                        <p class="bg-red-600 text-white text-center p-1 rounded w-full">{{ $borrow->status }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    @if ($borrow->status == "diajukan" || $borrow->status == "dipinjam")
                                        <div class="text-yellow-500">
                                            <a href="/dashboard/borrow/{{ $borrow->id }}/edit"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        </div>
                                    @elseif ($borrow->status == "ditolak" || $borrow->status == "dikembalikan")
                                        <div class="text-rose-500">
                                            <form action="/dashboard/borrow/{{ $borrow->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="hover:cursor-pointer" onclick="return confirm('Are you sure?')" type="submit"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>             
                        @endforeach
                    @else
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td colspan="7" class="text-center px-6 py-4 text-white">
                                Belum ada data peminjaman.
                            </td>
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

    @endsection