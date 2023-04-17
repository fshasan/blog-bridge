<x-app-layout>
    @if (DB::table('subscriptions')->count() == 0)
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Purchase a plan first!') }}
            </h2>
        </x-slot>
    @else
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form method="POST" action="{{ route('posts.store') }}" id="postForm">
                @csrf
                <label for="title">Title</label>
                <input id="title" placeholder="{{ __('Give a title') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3 mb-3"
                    name="title" type="text">
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="{{ __('What\'s on your mind?') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-3"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                @if (Auth::user()->is_admin == App\Enums\UserType::USER && $userPlan->stripe_price === App\Enums\PlanType::PREMIUM)
                    <button class="btn btn-primary btn-block shadow rounded-pill mt-2" type="submit" name="action" value="scheduledPost"><b>Schedule</b></button>
                @endif
                <button class="btn btn-primary btn-block shadow rounded-pill mt-2 ml-4" type="submit" name="action" value="post"><b>Post</b></button>
                <button id="resetBtn" type="button" class="btn btn-primary btn-block shadow rounded-pill mt-2 ml-4">Reset</button>
            </form>
            <h1 class="mt-4"><center><b>Newsfeed</b></center></h1>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                @foreach ($posts as $post)
                    <div class="p-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $post->user->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $post->created_at }}</small>
                                    @unless($post->created_at->eq($post->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
                                </div>
                                @if ($post->user->is(auth()->user()))
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('posts.edit', $post)">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-link :href="route('posts.destroy', $post)"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                @endif
                            </div>
                            <p class="mt-4 text-lg text-gray-900"><i>{{ $post->title }}</i></p>
                            <p class="mt-4 text-lg text-gray-900">{{ $post->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $posts->links() }}  
            </div>
        </div>

    @endif
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#resetBtn").click(function(){
                $("#postForm").trigger("reset");
            });
        });
    </script>

</x-app-layout>
