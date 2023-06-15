<?php

namespace minipress\core\services;

use minipress\core\models\Categorie;

class CategorieService {

    public static function getAllCategories() {
        return Categorie::all();
    }

    public static function getCategorieById($id) {
        return Categorie::find($id);
    }

    public static function createCategorie($name) {
        $categorie = new Categorie();
        $categorie->name = $name;
        $categorie->save();
    }

}
