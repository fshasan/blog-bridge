<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to your Dashboard!!') }}
            {{ Auth::user()->name}}
        </h2>
    </x-slot>
    @if (Auth::user()->is_admin === App\Enums\UserType::ADMIN)
        @foreach ($users as $user)
            <p>{{$user->name}}</p>
        @endforeach
    @else
        
    @endif
</x-app-layout>
