<?php
declare(strict_types=1);


namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Article extends Database
{
    protected $table = 'articles';

    protected $fillable = [
        'title',
        'slug',
        'intro_image',
        'intro_text',
        'user_id',
        'content',
        'created_at',
        'deleted_at',
        'favorites',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function test()
    {
        $articles = Article::all();
        dd($articles);
    }

}