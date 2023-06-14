import {afficherArticles, afficherCategories} from "./ui/Liste_ui";
import {load} from "./Fetcher";

function listePlusRecent(){
    afficherArticles(load("/api/articles"));
}

function listeDeLaCategorie(id){
    afficherArticles(load("/api/categories/" + id + "/articles"));
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

document.getElementById("categorie").addEventListener("click",listeDeLaCategorie(event.target.value));