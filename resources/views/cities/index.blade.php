<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Cities') }}
            </h2>
            <div class="flex gap-2">
                <a
                    href="{{ route('cities.export', ['format' => 'csv']) }}"
                    class="text-gray-800 border p-2 rounded-md bg-white hover:text-white hover:bg-gray-800 transition"
                >
                    Export CSV
                </a>
                <a
                    href="{{ route('cities.export', ['format' => 'xls']) }}"
                    class="text-gray-800 border p-2 rounded-md bg-white hover:text-white hover:bg-gray-800 transition"
                >
                    Export XLS
                </a>
                <a
                    href="{{ route('cities.create') }}"
                    class="text-gray-800 border p-2 duration-300 rounded-md bg-white hover:text-white hover:bg-gray-800 transition"
                >
                    Create City
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- used to have bg-white or dark:bg-gray-800 -->
            <div class="dark:text-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 md:grid-cols-2 gap-4 px-6">
                @foreach ($cities as $index => $city)
                    <div
                        x-data="{ open: false, editing: false }"
                        class="w-full bg-white dark:bg-gray-800 rounded-md shadow-sm border scale-90 hover:scale-100 hover:border-indigo-600 transition overflow-hidden"
                    >
                        {{-- Vista principal --}}
                        <div x-show="!open && !editing" class="flex flex-col justify-between h-full">
                            <div class="p-4 space-y-2">
                                <p class="font-bold">{{ $city->name }}</p>
                                <p>{{ $city->description }}</p>
                            </div>
                            <div class="p-4 flex items-center gap-2">
                                <button
                                    @click="editing = true"
                                    class="border-[1px] p-2 rounded-md border-white hover:bg-white hover:text-black transition"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="open = true"
                                    class="border-red-600 text-red-600 border p-2 rounded-lg hover:bg-red-600 hover:text-gray-200 transition"
                                >
                                    Delete
                                </button>
                            </div>
                        </div>

                        {{-- Vista de confirmación para eliminar --}}
                        <div x-show="open" class="flex flex-col justify-between h-full">
                            <div class="p-4 space-y-2">
                                <p class="font-bold">
                                    Are you sure you want to delete “{{ $city->name }}”?
                                </p>
                            </div>
                            <div class="p-4 flex items-center gap-2">
                                <form action="{{ route('cities.destroy', $city) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="border-red-600 text-red-600 border p-2 rounded-lg hover:bg-red-600 hover:text-gray-200 transition"
                                    >
                                        Yes, Delete
                                    </button>
                                </form>
                                <button
                                    @click="open = false"
                                    class="border p-2 rounded-md hover:bg-gray-200 transition"
                                >
                                    Cancel
                                </button>
                            </div>
                        </div>

                        {{-- Vista de edición --}}
                        <div x-show="editing" class="p-4">
                            <form action="{{ route('cities.update', ['city' => $city->id]) }}" method="POST" class="space-y-6">
                                @csrf
                                @method("PUT")
                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $city->name)" />
                                </div>
                                <div>
                                    <x-input-label for="description" :value="__('Description')" />
                                    <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $city->description)" />
                                </div>
                                <div class="flex justify-center">
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $cities->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
