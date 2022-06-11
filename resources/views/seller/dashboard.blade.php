<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seller Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
                <div class="pl-5 py-5 text-2xl">
                    user name : {{Auth::guard('seller')->user()->name}}<BR>
                    email : {{Auth::guard('seller')->user()->email}}<BR>
                    guard : {{getActiveGuard()}}
                </div>
            </div>
            <div class="p-6 sm:rounded-lg bg-yellow-100 border-b border-gray-200 text-2xl text-blue-400">
                <a href={{route('welcome')}}>Welcome Page로</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</x-app-layout>
