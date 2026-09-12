<?php

namespace App\Modules\Demo\Models;

use Illuminate\Database\Eloquent\Model;
use Zofe\Rapyd\Traits\SSearch;

class Author extends Model
{
    use SSearch;

    public $table = 'demo_authors';

    protected $fillable = ['firstname', 'lastname'];

    public static function ssearchFallback($query)
    {
        return static::query()
            ->where('firstname', 'like', $query . '%')
            ->orWhere('lastname', 'like', $query . '%');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
