<?php

namespace minipress\core\services;

use minipress\core\models\Categorie;

class CategorieService {

    public static function getAllCategories() {
        return Categorie::all()->toArray();
    }

    public static function getCategorieById($id) {
        return Categorie::find($id)->toArray();
    }

    public static function makeCategorie($data) {
        $filterLibelle = filter_var($data['libelle'], FILTER_SANITIZE_SPECIAL_CHARS);
        $filterDescription = filter_var($data['description'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($data['libelle'] != $filterLibelle) {
            throw new \Exception("Erreur de saisie");
        }
        if ($data['description'] != $filterDescription) {
            throw new \Exception("Erreur de saisie");
        }

        $categorie = new Categorie($data);
        $categorie->save();
    }

    public static function updateCategorie($data){
        $categorie = Categorie::find($data['id']);
        $categorie->libelle = $data['libelle'];
        $categorie->description = $data['description'];
        $categorie->save();
    }

    public static function deleteCategorie($id){
        $categorie = Categorie::find($id);
        $categorie->delete();
    }

}
