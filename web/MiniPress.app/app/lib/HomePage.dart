import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'CategoriesPage.dart';
import 'article.dart';
import 'ArticlePage.dart';
import 'categorie.dart';


class HomePage extends StatefulWidget {
  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  List<Article> articles = []; // Liste des articles
  List<Category> categories = []; // Liste des catégories

  @override
  void initState() {
    super.initState();
    fetchArticles(); // Appel à la fonction pour récupérer les articles depuis l'API
    fetchCategories(); // Appel à la fonction pour récupérer les catégories depuis l'API
  }

  Future<void> fetchArticles() async {
    final response = await http.get(Uri.parse(
        'http://docketu.iutnc.univ-lorraine.fr:27002/Sae_CMS/web/MiniPress.core/index.php/api/articles?sort=date-asc'));
    if (response.statusCode == 200) {
      final jsonData = json.decode(response.body);
      setState(() {
        articles =
        List<Article>.from(jsonData.map((data) => Article.fromJson(data)));
      });
    } else {
      // Gestion des erreurs
    }
  }

  Future<void> fetchCategories() async {
    final response = await http.get(Uri.parse(
        'http://docketu.iutnc.univ-lorraine.fr:27002/Sae_CMS/web/MiniPress.core/index.php/api/categories/'));
    if (response.statusCode == 200) {
      final jsonData = json.decode(response.body);
      setState(() {
        categories =
        List<Category>.from(jsonData.map((data) => Category.fromJson(data)));
      });
    } else {
      // Gestion des erreurs
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('MiniPress App'),
        actions: [
          Row(
            children: [
              Text(
                'Catégories',
                style: TextStyle(fontSize: 16),
              ),
              IconButton(
                icon: Icon(Icons.category),
                onPressed: () {
                  // Naviguer vers la page des catégories
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) =>
                          CategoriesPage(categories: categories),
                    ),
                  );
                },
              ),
            ],
          ),
        ],
      ),
      body: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Padding(
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
                return ListTile(
                  title: Text(article.title),
                  subtitle: Text(
                      'Auteur: ${article.author} - Date de création: ${article
                          .creationDate}'),
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
              },
            ),
          ),
          Divider(), // Ligne en dessous de la liste des articles
        ],
      ),
    );
  }
}

