import {afficherArticles, afficherCategories, afficherContennuArticle} from "./ui/Liste_ui.js";
import {load} from "./Fetcher.js";

function listePlusRecent(){
    afficherArticles(load("/api/articles"));
}

export function listeDeLaCategorie(id){
    afficherArticles(load("/api/categories/" + id + "/articles"));
}

export function contenuArticle(article){
    afficherContennuArticle(load(article))
}

function listeArticleDeAuteur(id){
    afficherArticles(load("/api/auteur/" + id + "/articles"));
}

function categories(){
    afficherCategories(load("/api/categories"));
}

document.addEventListener('DOMContentLoaded',function () {
    listePlusRecent();
    categories();
});

listePlusRecent();
categories();