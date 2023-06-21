import {contenuArticle, listeDeLaCategorie, listeArticleDeAuteur} from "../ListeArcticle.js";

export function afficherArticles(promesse) {
    var html = "";
    promesse.then(articles => {
        articles.forEach(article => {
            html += "<section class='article' value='" + article.id + "'>" +
                "<img src='" +
                article.image +
                "'> <h4>" +
                article.titre +
                "</h4> <h6>" +
                article.date_de_creation +
                "</h6> <h6 class='auteur' value='" +
                article.auteur +
                "'>" +
                article.auteur +
                "</h6> </section>";
        })
        document.getElementById("articles").innerHTML = html;

        document.querySelectorAll(".article").forEach(section => {
            section.addEventListener("click", function (event) {
                if (!event.target.classList.contains('auteur')) {
                    contenuArticle(section.getAttribute("value"));
                }
            });
        })

        document.querySelectorAll(".auteur").forEach(section => {
            section.addEventListener("click", function () {
                listeArticleDeAuteur(section.getAttribute("value"),
                document.getElementById("titre").innerText = "Article de " + section.getAttribute("value"));
            });
        })
    })
}

export function afficherCategories(promesse) {
    var html = "";
    promesse.then(categories => {
        categories.forEach(categorie => {
            html += "<h5 id='categorie' value='" +
                categorie.id +
                "' categ='" +
                categorie.libelle +
                "'>" +
                categorie.libelle +
                "</h5>";
        })
        document.getElementById("categories").innerHTML = html;

        document.querySelectorAll("#categories h5").forEach(section => {
            section.addEventListener("click", function () {
                listeDeLaCategorie(section.getAttribute("value"),
                document.getElementById("titre").innerText = "Article de la categorie " + section.getAttribute("categ"));
            });
        })
    })
}

export function afficherContennuArticle(promesse) {
    promesse.then(article => {
        document.getElementById("articles").innerHTML = "<h5>" +
            article.date_de_publication +
            "</h5>"+
            "<h2>" +
            article.titre +
            "</h2>" +
            "<p>" +
            article.contenu +
            "</p>" +
            "<h4>" +
            article.auteur +
            "</h4>";
    })
}