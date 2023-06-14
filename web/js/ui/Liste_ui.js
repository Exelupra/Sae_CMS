export function afficherArticles(promesse){
    promesse.then(articles => {
        var html = "";
        articles.forEach(article => {
            html += "<section id='article'>" +
                "<img src='" +
                article.lien + // /!\ Position du lien de l'image a confirmé!
                "'></img> <h4>" +
                article.titre + // /!\ Position du titre de l'article a confirmé!
                "</h4> <h6>" +
                article.auteur + // /!\ Position du nom de l'auteur a confirmé!
                "</h6> </section>";
        })
        document.getElementById(articles).innerHTML = html;
    })
}

export function afficherCategorie(promesse){
    promesse.then(categories => {
        var html = "";
        categories.forEach(categorie => {
            html += "<h5 id='" +
            categorie.id +
            "'>" +
            categorie.nom +
            "</h5>";
        })
        document.getElementById(categories).innerHTML = html;
    })
}