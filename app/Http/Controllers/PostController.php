<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Enums\PostsPerDay;
use App\Enums\PlanType;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {   
        $userSubscription = $this->getCurrentSubscription();

        $count = $this->totalPostsToday();

        if(($userSubscription->stripe_price == PlanType::FREE) && ($count == PostsPerDay::FREE_USER_LIMIT))
        {
            return redirect(route('posts.index'))->with('warning', "Free users are not allowed to publish more than two (2) posts a day!");
        }
        else
        {
            $validated = $request->validate([
                'title' => 'required|string|max:100',
                'description' => 'required',
            ]);

            $request->user()->posts()->create($validated);
     
            return redirect(route('posts.index'))->with('success', "Post created successfully!");
        }
    }

    public function totalPostsToday()
    {
        $data = Post::with('user')
                ->where('user.id', Auth::id())
                ->where('created_at', '>=', Carbon::now()->startOfDay())
                ->count();
        
        return $data;
    }

    public function getCurrentSubscription()
    {
        $data = DB::table('subscriptions')->where('user_id', Auth::id());

        return $data;
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
 
        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
 
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required',
        ]);
 
        $post->update($validated);
 
        return redirect(route('posts.index'));
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
 
        $post->delete();
 
        return redirect(route('posts.index'));
    }
}
