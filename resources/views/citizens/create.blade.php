
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
            <div class="dark:text-white bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 gap-4 px-6">
                <!-- <div class="text-gray-900 dark:text-gray-100"> -->

                    <form action="{{ route('citizens.store') }}" method="POST" class="space-y-6 w-full p-2"> @csrf
                    <div>
                        <x-input-label for="first_name" :value="__('First Name')" />
                        <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full"  />
                    </div>
                    <div>
                        <x-input-label for="last_name" :value="__('Last Name')" />
                        <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" />
                    </div>
                    <div>
                        <x-input-label for="birth_date" :value="__('Birthday')" />
                        <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" />
                    </div>
                    <div>
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" />
                    </div>

                    <div>
                        <x-input-label for="phone" :value="__('Phone')" />
                        <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" />
                    </div>
                    <div class="p-4 border-[1px] border-gray-200 rounded-md">

                    <span class="mb-3 block">City</span>
                        @foreach ($cities as $city)

 <label for="city_{{ $city->id }}" class="flex items-center space-x-2">
                <input
                    id="city_{{ $city->id }}"
                    name="city_id"
                    type="radio"
                    value="{{ $city->id }}"
                    class="h-4 w-4 text-indigo-600 dark:text-indigo-500 border-gray-300 focus:ring-indigo-500"
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
    </div>
</x-app-layout>
