<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Enums\UserType;
use App\Enums\PostsPerDay;
use App\Enums\PlanType;
use App\Mail\UserPostMail;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        $userPlan = $this->getCurrentSubscription();

        return view('posts.index', compact('posts', 'userPlan'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {   
        $userSubscription = $this->getCurrentSubscription();

        $count = $this->totalPostsToday();

        if(($userSubscription->stripe_price === PlanType::FREE) && ($count == PostsPerDay::FREE_USER_LIMIT))
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

            $email = User::select('email')
                        ->where('is_admin', UserType::ADMIN)
                        ->first();

            $mailData = [
                'user' => Auth::id(),
                'title' => $request->input('title'),
                'description' => $request->input('description')
            ];

            Mail::to($email)->send(new UserPostMail($mailData));
     
            return redirect(route('posts.index'))->with(array('success' => 'Post created successfully!', 'success' => 'Mail Sent to Admin!'));
        }

    }

    public function totalPostsToday()
    {
        $data = Post::where('user_id', Auth::id())
                    ->where('created_at', '>=', Carbon::now()->startOfDay())
                    ->count();            
        return $data;
    }

    public function getCurrentSubscription()
    {
        $data = DB::table('subscriptions')->where('user_id', Auth::id())->first();

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
