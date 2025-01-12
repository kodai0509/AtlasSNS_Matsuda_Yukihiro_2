<?php

declare(strict_types=1);


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['content', 'user_id'];

    // Userリレーションを定義
    public function user()
    {
        return $this->belongsTo(User::class); // PostはUserに属している
    }
}
