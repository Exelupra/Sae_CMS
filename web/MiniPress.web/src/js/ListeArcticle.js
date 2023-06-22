import {afficherArticles, afficherCategories, afficherContennuArticle} from "./ui/Liste_ui.js";
import {load} from "./Fetcher.js";

export function listePlusRecent(){
    document.getElementById("titre").innerText = "Article les plus recent";
    afficherArticles(load("/articles?sort=date-desc"));
}

export function listePlusVieux(){
    document.getElementById("titre").innerText = "Article les plus vieux";
    afficherArticles(load("/articles?sort=date-asc"));
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
    afficherArticles(load("/auteurs/" + nom + "/articles"));
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