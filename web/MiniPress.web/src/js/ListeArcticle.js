import {afficherArticles, afficherCategories, afficherContennuArticle} from "./ui/Liste_ui.js";
import {load} from "./Fetcher.js";

function listePlusRecent(){
    afficherArticles(load("/articles"));
}

export function listeDeLaCategorie(id){
    afficherArticles(load("/categories/" + id + "/articles"));
}

export function contenuArticle(article){
    afficherContennuArticle(load(article))
}

function listeArticleDeAuteur(id){
    afficherArticles(load("/auteur/" + id + "/articles"));
}

function categories(){
    afficherCategories(load("/categories"));
}

document.addEventListener('DOMContentLoaded',function () {
    listePlusRecent();
    categories();
});

listePlusRecent();
categories();