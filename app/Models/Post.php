<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function totalPostsToday()
    {
        $data = $this->where('user_id', Auth::id())
                    ->where('created_at', '>=', now()->startOfDay())
                    ->count();
        return $data;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
