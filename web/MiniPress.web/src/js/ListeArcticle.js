import {afficherArticles, afficherCategories, afficherContennuArticle} from "./ui/Liste_ui.js";
import {load} from "./Fetcher.js";

function listePlusRecent(){
    document.getElementById("titre").innerText = "Article les plus recent";
    afficherArticles(load("/articles"));
}

export function listeDeLaCategorie(id){
    afficherArticles(load("/categories/" + id + "/articles"));
}

export function contenuArticle(id){
    document.getElementById("titre").innerText = " ";
    afficherContennuArticle(load("/articles/" + id));
}

export function listeArticleDeAuteur(nom){
    document.getElementById("titre").innerText = "Article d'un auteur"; // a retirée
    afficherArticles(load("/auteur/" + nom + "/articles"));
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