import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../Models/article.dart';
import 'ArticlePage.dart';

class CategoryArticlesPage extends StatefulWidget {
  final int categoryId;

  CategoryArticlesPage({required this.categoryId});

  @override
  _CategoryArticlesPageState createState() => _CategoryArticlesPageState();
}

class _CategoryArticlesPageState extends State<CategoryArticlesPage> {
  List<Article> articles = [];

  @override
  void initState() {
    super.initState();
    fetchArticlesByCategory(widget.categoryId);
  }

  Future<void> fetchArticlesByCategory(int categoryId) async {
    final response = await http.get(Uri.parse('http://docketu.iutnc.univ-lorraine.fr:27002/Sae_CMS/web/MiniPress.core/index.php/api/categories/$categoryId/articles'));
    if (response.statusCode == 200) {
      final jsonData = json.decode(response.body);
      setState(() {
        articles = List<Article>.from(jsonData.map((data) => Article.fromJson(data)));
      });
    } else {
      // Gestion des erreurs
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Articles de la catégorie'),
      ),
      body: ListView.builder(
        itemCount: articles.length,
        itemBuilder: (context, index) {
          final article = articles[index];
          return ListTile(
            title: Text(article.title),
            subtitle: Text('Auteur: ${article.author} - Date de création: ${article.creationDate}'),
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
    );
  }
}
