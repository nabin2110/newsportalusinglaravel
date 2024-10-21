<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'rank'
    ];

    public static function boot(){
        parent::boot();
        
        self::creating(function ($model){
            $model->rank = self::saveRank();
        });
        self::deleting(function ($model){
            self::decrementRank($model->rank);
        });
    }
    public static function saveRank(){
        $rank = self::max('rank');
        return $rank !== null ? $rank + 1 : 1;
    }
    public static function decrementRank($deletedRank){
        self::where('rank','>',$deletedRank)->decrement('rank');
    }
} #}
