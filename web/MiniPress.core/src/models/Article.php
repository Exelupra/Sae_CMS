<?php

namespace minipress\core\models;

class Article extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'article';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'titre',
        'resume',
        'contenu',
        'cat_id',
        'auteur'
    ];

    protected $dateformat = 'Y-m-d H:i:s';

    public function categorie(){
        return $this->belongsTo(Categorie::class, 'cat_id');
    }

    public function utilisateur(){
        return $this->belongsTo(Utilisateur::class, 'auteur');
    }

}