<?php

namespace MiniPress\core\models;

use Illuminate\Database\Eloquent\Model;


class Utilisateur extends Model {

    protected $table = 'utilisateur';
    protected $primaryKey = 'string';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'mail',
        'mdp',
        'admin',
    ];


    //elle sera connecter son id à auteur de article
public function article(){
        return $this->hasMany('MiniPress\core\models\Article', 'auteur');
    }



}