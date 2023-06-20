<?php

namespace minipress\core\services;

use minipress\core\models\Article;

class ArticleService {

    public static function getAllArticle() {
        return \minipress\core\models\Article::whereNotNull('date_de_publication')->get()->toArray();
    }

    public static function getUnpublished() {
        return \minipress\core\models\Article::whereNull('date_de_publication')->get()->toArray();
    }

    public static function getArticleById($id) {
        return \minipress\core\models\Article::find($id);
    }

    public static function makeArticle($article){
        $filterTitre = filter_var($article['titre']);
        $filterResume = filter_var($article['resume']);
        $filterContenu = filter_var($article['contenu']);

        if($article['titre'] != $filterTitre){
            throw new \Exception("Erreur de saisie");
        }
        if($article['resume'] != $filterResume){
            throw new \Exception("Erreur de saisie");
        }
        if($article['contenu'] != $filterContenu){
            throw new \Exception("Erreur de saisie");
        }

        $article = new \minipress\core\models\Article($article);
        $article->id = Article::all()->max('id')+1;
        $article->save();
    }
}