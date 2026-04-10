@extends('dashboard.layouts.main')

@section('kontent')
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-9 p-4">
        @if (session()->has('success'))
        <div class="mb-5 rounded-lg bg-green-100 px-6 py-5 text-sm text-green-800 border border-green-300" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <a href="/dashboard/user/create" class="px-5 py-3 bg-sky-300 rounded-md text-gray-500 hover:bg-sky-400 transition">Tambah User</a>
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
                            Nama pengguna
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Slug
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->count())
                    @foreach ($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->slug }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->username }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <form action="/dashboard/user/{{ $user->slug }}" method="POST" class="text-red-500 hover:text-red-700 transition">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')">
                                    <i class="fa-sharp fa-solid fa-trash"></i>Delete
                                </button>
                            </form>
                            <p>|</p>
                            <div class="text-yellow-600 hover:text-yellow-700 transition">
                                <a href="/dashboard/user/{{ $user->slug }}/edit"><i class="fa-sharp fa-solid fa-edit"></i>Edit</a>
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
                {{ $users->links() }}
            </div>

        </div>
    </div>
</div>

@endsection