<?php

namespace minipress\core\models;

use minipress\core\models\Article;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model{
    protected $table = 'categorie';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function articles(){
        return $this->hasMany(Article::class, 'cat_id');
    }

}