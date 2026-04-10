@extends('dashboard.layouts.main')

@section('kontent')
        <div class="p-6">
 
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-3">
                    <h2 class="text-2xl font-bold text-gray-800">Welcome back, {{ auth()->user()->name }}!</h2>
                    <p class="text-gray-600 mt-2">Here's what's happening with your library today.</p>
                </div>
            </div>
        </div>
@endsection