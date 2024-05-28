<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
                <button onclick="window.location.href='{{route('categories.create')}}'"
                        class="bg-blue-300 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded inline-flex items-center float-right">
                    <i class="fa-solid fa-add"></i>
                    <span class="ml-3" >Ekle</span>
                </button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <x-category :categories="$categories" />
            </div>
        </div>
    </div>
</x-app-layout>
