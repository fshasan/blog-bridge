<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Choose a Plan') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-5 rounded-lg shadow">
                <h1 class="h6 text-uppercase font-weight-bold mb-4">FREE</h1>
                <h2 class="h1 font-weight-bold">$0<span class="text-small font-weight-normal ml-2">/ free</span></h2>

                <div class="custom-separator my-4 mx-auto bg-primary"></div>

                <ul class="list-unstyled my-5 text-small text-left">
                    <li class="mb-3">
                        <i class="fa fa-check mr-2 text-primary"></i> Lorem ipsum dolor sit amet
                    </li>
                    <li class="mb-3">
                        <i class="fa fa-check mr-2 text-primary"></i> Sed ut perspiciatis
                    </li>
                    <li class="mb-3">
                        <i class="fa fa-check mr-2 text-primary"></i> At vero eos et accusamus
                    </li>
                </ul>
                <a href="#" class="btn btn-primary btn-block shadow rounded-pill">Buy Now</a>
            </div>
        </div>
    </div>
</x-app-layout>
