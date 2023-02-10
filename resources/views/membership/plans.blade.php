<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Choose a Plan') }}
        </h2>
    </x-slot>

    @foreach ($plans as $plan)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <div class="bg-white p-5 rounded-lg shadow">
                    <h1 class="h6 text-uppercase font-weight-bold mb-4">{{$plan->name}}</h1>
                    <h2 class="h1 font-weight-bold">${{ $plan->price }}<span class="text-small font-weight-normal ml-2">/ month</span></h2>

                    <div class="custom-separator my-4 mx-auto bg-primary"></div>

                    <ul class="list-unstyled my-5 text-small text-left">
                        <li class="mb-3">
                            <i class="fa fa-check mr-2 text-primary"></i> {{ $plan->description }}
                        </li>
                    </ul>
                    <x-primary-button class="mt-4">Buy now</x-primary-button>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
