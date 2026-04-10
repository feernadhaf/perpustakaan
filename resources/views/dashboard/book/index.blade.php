@extends('dashboard.layouts.main')

@section('kontent')
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-9 p-4">
        @if (session()->has('success'))
        <div class="mb-5 rounded-lg bg-green-100 px-6 py-5 text-sm text-green-800 border border-green-300" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <a href="/dashboard/book/create" class="px-5 py-3 bg-sky-300 rounded-md text-gray-500 hover:bg-sky-400 transition">Tambah book</a>
    </div>
</div>

<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-12 p-4">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            judul Buku
                        </th>
                        <th scope="col" class="px-6 py-3">
                            kategori
                        </th>
                        <th scope="col" class="px-6 py-3">
                            penulis
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cover
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @if ($books->count())
                    @foreach ($books as $book)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $book->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $book->category->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $book->author->name }}
                        </td>
                        <td class="px-6 py-4">
                            <img class="w-11" src="{{ Storage::url($book->cover) }}" alt="">
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <form action="/dashboard/book/{{ $book->slug }}" method="POST" class="text-red-500 hover:text-red-700 transition">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')">
                                    <i class="fa-sharp fa-solid fa-trash"></i>Delete
                                </button>
                            </form>
                            <p>|</p>
                            <div class="text-yellow-600 hover:text-yellow-700 transition">
                                <a href="/dashboard/book/{{ $book->slug }}/edit"><i class="fa-sharp fa-solid fa-edit"></i>Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <td colspan="7" class="px-6 py-4 text-white text-center ">
                            Belum ada data category.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {{-- Pagination --}}
            <div class="mt-6 ">     
                {{ $books->links() }}
            </div>
        </div>
    </div>
</div>

@endsection