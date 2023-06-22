document.addEventListener('DOMContentLoaded', function() {
    var categorieSelect = document.getElementById('categorie');
    categorieSelect.addEventListener('change', function() {
        var categorieId = this.value;
        updateArticles(categorieId);
    });
function updateArticles(categorieId) {
    var url = 'api/categories/' + categorieId + '/articles';
    fetch(url)
        .then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Une erreur s\'est produite lors de la récupération des articles.');
            }
        })
        .then(function(articles) {
            var articlesContainer = document.createElement('div');
            var allArticles = document.querySelector('#allArticles');
            allArticles.innerHTML = '';
            if (articles.length > 0) {
                articles.forEach(function(article) {
                    if(article.date_de_publication != null){
                        var articleHtml = '<div class="article">' +
                            '<h2>' + article.titre + '</h2>' +
                            '<p>' + article.resume + '</p>' +
                            '<p><a href="' + article.url + '">Read more</a></p>' +
                            '</div>';

                        articlesContainer.innerHTML += articleHtml;

                        allArticles.append(articlesContainer);
                    }
                });

            } else {
                articlesContainer.innerHTML = '<p>Aucun article trouvé.</p>';
            }
        })
}
});

