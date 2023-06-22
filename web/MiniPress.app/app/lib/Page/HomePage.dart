import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'CategoriesPage.dart';
import '../Filtre/FilterDialog.dart';
import '../Models/article.dart';
import '../Models/categorie.dart';
import 'ArticlePage.dart';

enum SortOrder {
  dateDesc,
  dateCDesc,
  dateCAsc,
}

class HomePage extends StatefulWidget {
  const HomePage({Key? key}) : super(key: key);

  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  List<Article> articles = []; // Liste des articles
  List<Category> categories = []; // Liste des catégories
  SortOrder currentSortOrder = SortOrder.dateDesc; // Tri par défaut en ordre descendant
  String keyword = ''; // Mot-clé de filtrage des articles

  @override
  void initState() {
    super.initState();
    fetchArticles(currentSortOrder); // Appel à la fonction pour récupérer les articles depuis l'API avec le tri initial
    fetchCategories(); // Appel à la fonction pour récupérer les catégories depuis l'API
  }

  Future<void> fetchArticles(SortOrder sortOrder) async {
    String sortParam;
    switch (sortOrder) {
      case SortOrder.dateDesc:
        sortParam = 'date-desc';
        break;
      case SortOrder.dateCDesc:
        sortParam = 'dateC-desc';
        break;
      case SortOrder.dateCAsc:
        sortParam = 'dateC-asc';
        break;
    }

    try {
      final response = await http.get(Uri.parse(
          'http://docketu.iutnc.univ-lorraine.fr:27002/Sae_CMS/web/MiniPress.core/index.php/api/articles?sort=$sortParam'));
      if (response.statusCode == 200) {
        final jsonData = json.decode(response.body);
        setState(() {
          articles = List<Article>.from(jsonData.map((data) => Article.fromJson(data)));
        });
      } else {
        showErrorMessage('Erreur de chargement des articles');
      }
    } catch (error) {
      showErrorMessage('Une erreur s\'est produite lors de la requête');
    }
  }

  Future<void> fetchCategories() async {
    try {
      final response = await http.get(Uri.parse(
          'http://docketu.iutnc.univ-lorraine.fr:27002/Sae_CMS/web/MiniPress.core/index.php/api/categories/'));
      if (response.statusCode == 200) {
        final jsonData = json.decode(response.body);
        setState(() {
          categories = List<Category>.from(jsonData.map((data) => Category.fromJson(data)));
        });
      } else {
        showErrorMessage('Erreur de chargement des catégories');
      }
    } catch (error) {
      showErrorMessage('Une erreur s\'est produite lors de la requête');
    }
  }

  void showErrorMessage(String message) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message),
      ),
    );
  }

  void filterArticles() {
    if (keyword.isEmpty) {
      // Si le mot-clé est vide, afficher tous les articles
      fetchArticles(currentSortOrder);
    } else {
      // Filtrer les articles en fonction du mot-clé dans le titre ou le résumé
      setState(() {
        articles = articles
            .where((article) =>
        article.title.toLowerCase().contains(keyword.toLowerCase()) ||
            article.summary.toLowerCase().contains(keyword.toLowerCase()))
            .toList();
      });
    }
  }

  Future<String> fetchPseudo(String authorId) async {
    try {
      final response = await http.get(Uri.parse(
          'http://docketu.iutnc.univ-lorraine.fr:27002/Sae_CMS/web/MiniPress.core/index.php/api/auteur/$authorId'));
      if (response.statusCode == 200) {
        final jsonData = json.decode(response.body);
        final pseudo = jsonData[0]['pseudo'];
        return pseudo;
      } else {
        showErrorMessage('Erreur de chargement du pseudo');
        return '';
      }
    } catch (error) {
      showErrorMessage('Une erreur s\'est produite lors de la requête');
      return '';
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('MiniPress App'),
        actions: [
          Row(
            children: [
              IconButton(
                icon: const Icon(Icons.category),
                onPressed: () {
                  // Naviguer vers la page des catégories
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => CategoriesPage(categories: categories),
                    ),
                  );
                },
              ),
            ],
          ),
          IconButton(
            icon: const Icon(Icons.sort),
            onPressed: () {
              setState(() {
                if (currentSortOrder == SortOrder.dateDesc) {
                  currentSortOrder = SortOrder.dateCDesc;
                } else if (currentSortOrder == SortOrder.dateCDesc) {
                  currentSortOrder = SortOrder.dateCAsc;
                } else {
                  currentSortOrder = SortOrder.dateDesc;
                }
                fetchArticles(currentSortOrder); // Appel à la fonction pour récupérer les articles avec le nouveau tri
              });
            },
          ),
          IconButton(
            icon: const Icon(Icons.filter_list),
            onPressed: () async {
              final result = await showDialog<String>(
                context: context,
                builder: (context) => FilterDialog(),
              );
              if (result != null) {
                setState(() {
                  keyword = result;
                  filterArticles(); // Appliquer le filtre aux articles
                });
              }
            },
          ),
        ],
      ),
      body: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Padding(
            padding: EdgeInsets.symmetric(vertical: 8.0, horizontal: 16.0),
            child: Text(
              'Articles :',
              style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
            ),
          ),
          Expanded(
            child: ListView.builder(
              itemCount: articles.length,
              itemBuilder: (context, index) {
                final article = articles[index];
                return FutureBuilder<String>(
                  future: fetchPseudo(article.author),
                  builder: (context, snapshot) {
                    if (snapshot.connectionState == ConnectionState.waiting) {
                      return ListTile(
                        title: Text(article.title),
                        subtitle: const Text('Chargement du pseudo...'),
                        onTap: () {
                          // Naviguer vers la page d'affichage complet de l'article
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                              builder: (context) => ArticlePage(article: article),
                            ),
                          );
                        },
                      );
                    } else if (snapshot.hasError) {
                      return ListTile(
                        title: Text(article.title),
                        subtitle: const Text('Erreur lors du chargement du pseudo.'),
                        onTap: () {
                          // Naviguer vers la page d'affichage complet de l'article
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                              builder: (context) => ArticlePage(article: article),
                            ),
                          );
                        },
                      );
                    } else {
                      final pseudo = snapshot.data!;
                      return ListTile(
                        title: Text(article.title),
                        subtitle: Text('Auteur: $pseudo - Date de création: ${article.creationDate}'),
                        onTap: () {
                          // Naviguer vers la page d'affichage complet de l'article
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                              builder: (context) => ArticlePage(article: article),
                            ),
                          );
                        },
                      );
                    }
                  },
                );
              },
            ),
          ),
          const Divider(), // Ligne en dessous de la liste des articles
        ],
      ),
    );
  }
}
