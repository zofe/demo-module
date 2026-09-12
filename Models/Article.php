<?php

namespace App\Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;
use Zofe\Rapyd\Traits\SSearch;

class Article extends Model
{
    use SSearch;

    public $table = 'demo_articles';

    protected $fillable = ['author_id', 'title', 'body', 'public', 'publication_date'];

    protected $attributes = ['public' => 0];

    protected $casts = ['public' => 'boolean', 'publication_date' => 'date'];

    protected static function booted(): void
    {
        static::creating(function (Article $article) {
            $article->publication_date ??= now();
        });
    }

    // Used by the search box (SSearch): title, body or author name.
    public static function ssearchFallback($query)
    {
        return static::query()->where(function ($q) use ($query) {
            $q->where('title', 'like', '%' . $query . '%')
                ->orWhere('body', 'like', '%' . $query . '%')
                ->orWhereHas('author', fn ($a) => $a->where('firstname', 'like', $query . '%')->orWhere('lastname', 'like', $query . '%'));
        });
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
