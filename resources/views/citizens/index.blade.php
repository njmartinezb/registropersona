<x-app-layout>
    <x-slot name="header" class="">
    <div class="flex flex-row justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Citizens') }}
        </h2>
        <a
            href="{{route('citizens.create')}}"
            class="text-gray-800 border p-2 duration-300 rounded-md bg-white hover:text-white hover:bg-gray-800 transition"
        >
        Create Citizen
        </a>
    </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- used to have bg-white or dark:bg-gray-800 -->
            <div class="dark:text-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 md:grid-cols-2 gap-4 px-6">
                <!-- <div class="text-gray-900 dark:text-gray-100"> -->
                @foreach ($citizens as $index => $citizen)
                        <div
                        x-data="{ open: false, editing: false }"
                        class="w-full bg-white dark:bg-gray-800 rounded-md shadow-sm border scale-90 hover:scale-100 hover:border-indigo-600 transition overflow-hidden"
                    >
                        {{-- Main view --}}
                        <div
                            x-show="!open && !editing"
                            class="flex flex-col justify-between h-full"
                        >
                            <div class="p-4 space-y-2">
                                <p class="font-bold">{{ $citizen->first_name }} {{$citizen->last_name}}</p>
                                <p>{{ $citizen->phone }}</p>
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

                        {{-- Confirmation view --}}
                        <div
                            x-show="open"
                            class="flex flex-col justify-between h-full"
                        >
                            <div class="p-4 space-y2">
                                <p class="font-bold">
                                    Are you sure you want to delete “{{ $citizen->first_name }} {{$citizen->last_name}}”?
                                </p>
                            </div>
                            <div class="p-4 flex items-center gap-2">
                                <form action="{{ route('citizens.destroy', $citizen) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="border-red-600 text-red-600 border p-2 rounded-lg hover:bg-red-600 hover:text-gray-200 transition"
                                    >Yes, Delete</button>
                                </form>
                                <button
                                    @click="open = false"
                                    class="border p-2 rounded-md hover:bg-gray-200 transition"
                                >
                                    Cancel
                                </button>
                            </div>
                        </div>

                        {{-- Editing view --}}
                        <div
                        x-show="editing"
                        class="p-4"
                        >

                    <form action="{{ route('citizens.update', ['citizen' => $citizen->id]) }}" method="POST" class="space-y-6"> @csrf
                    @method("PUT")
                    <div>
                        <x-input-label for="first_name" :value="__('First Name')" />
                        <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $citizen->first_name)" />
                    </div>
                    <div>
                        <x-input-label for="last_name" :value="__('Last Name')" />
                        <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $citizen->last_name)" />
                    </div>
                    <div>
                        <x-input-label for="birth_date" :value="__('Birthday')" />
                        <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date', $citizen->birth_date)" />
                    </div>
                    <div>
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $citizen->address)" />
                    </div>

                    <div>
                        <x-input-label for="phone" :value="__('Phone')" />
                        <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $citizen->phone)" />
                    </div>

                    <div class="p-4 border-[1px] border-gray-200 rounded-md">

                    <span class="mb-3 block">City</span>
                        @foreach ($cities as $city)
                            <label for="city_{{ $city->id }}" class="flex items-center space-x-2">
                                <input
                                    id="city_{{ $city->id }}"
                                    name="city_id"
                                    type="radio"
                                    class="h-4 w-4 text-indigo-600 dark:text-indigo-500 border-gray-300 focus:ring-indigo-500"
                                    value="{{$city->id}}"
                                    @checked($city->id == $citizen->city_id)
                                />
                                <span class="text-gray-700 dark:text-gray-200">
                                    {{ $city->name }}
                                </span>
                            </label>
                        @endforeach
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
                <!-- </div> --->
            </div>
            <div class="mt-4">
                {{ $citizens->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
