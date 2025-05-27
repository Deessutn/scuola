<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Benvenuto, {{ auth()->user()->name }}!</h3>
                <p class="mt-4 text-gray-600 dark:text-gray-300">Questa è la tua dashboard.</p>

                <div class="mt-6">
                    <a href="{{ route('bands.index') }}" class="text-blue-600 hover:underline">Le tue bande</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
