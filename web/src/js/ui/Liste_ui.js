import {contenuArticle, listeDeLaCategorie} from "../ListeArcticle";

export function afficherArticles(promesse){
    promesse.then(article => {
        document.getElementById(articles).innerHTML = "<h2>" + article.titre + "</h2>" +
        "<p>" + article.contenue + "</p>";

        document.querySelectorAll("#articles section").forEach(section => {
            section.addEventListener("click", function () {
                contenuArticle(section.getAttribute("value"));
            });
        })
    })
}

export function afficherCategories(promesse){
    promesse.then(categories => {
        var html = "";
        categories.forEach(categorie => {
            html += "<h5 id='categorie' value='" +
            categorie.id +
            "'>" +
            categorie.nom +
            "</h5>";
        })
        document.getElementById(categories).innerHTML = html;

        document.querySelectorAll("#categories section").forEach(section => {
            section.addEventListener("click", function () {
                listeDeLaCategorie(section.getAttribute("value"));
            });
        })
    })
}

export function afficherContennuArticle(promesse){
    promesse.then(articles => {
        var html = "";
        articles.forEach(article => {
            html += "<section id='article' value='" + article.href + "'>" +
                "<img src='" +
                article.lien + // /!\ Position du lien de l'image a confirmé!
                "'></img> <h4>" +
                article.titre + // /!\ Position du titre de l'article a confirmé!
                "</h4> <h6>" +
                article.date + // /!\ Position de la date a confirmé!
                "</h6> <h6 id='auteur'>" +
                article.auteur + // /!\ Position du nom de l'auteur a confirmé!
                "</h6> </section>";
        })
        document.getElementById(articles).innerHTML = html;

    })
}