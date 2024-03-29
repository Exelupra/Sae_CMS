import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'AuthorArticlesPage.dart';
import '../Models/article.dart';

class ArticlePage extends StatefulWidget {
  final Article article;

  const ArticlePage({super.key, required this.article});

  @override
  _ArticlePageState createState() => _ArticlePageState();
}

class _ArticlePageState extends State<ArticlePage> {
  String categoryLabel = '';
  String authorPseudo = '';
  List<Article> authorArticles = [];

  @override
  void initState() {
    super.initState();
    fetchCategoryLabel();
    fetchAuthorArticles();
    fetchPseudo(widget.article.author);
  }

  Future<void> fetchCategoryLabel() async {
    final response = await http.get(Uri.parse(
        'http://docketu.iutnc.univ-lorraine.fr:27002/Sae_CMS/web/MiniPress.core/index.php/api/categorie/${widget.article.categoryId}'));
    if (response.statusCode == 200) {
      final jsonData = json.decode(response.body);
      setState(() {
        categoryLabel = jsonData['libelle'];
      });
    } else {
      // Gérer l'erreur de récupération de la catégorie
      setState(() {
        categoryLabel = 'Catégorie non disponible';
      });
    }
  }

  Future<void> fetchAuthorArticles() async {
    final response = await http.get(Uri.parse(
        'http://docketu.iutnc.univ-lorraine.fr:27002/Sae_CMS/web/MiniPress.core/index.php/api/auteurs/${widget.article.author}/articles'));
    if (response.statusCode == 200) {
      final jsonData = json.decode(response.body);
      List<Map<String, dynamic>> articlesData =
      List<Map<String, dynamic>>.from(jsonData);
      List<Article> articles =
      articlesData.map((data) => Article.fromJson(data)).toList();
      setState(() {
        authorArticles = articles;
      });
    } else {
      // Gérer l'erreur de récupération des articles de l'auteur
      setState(() {
        authorArticles = [];
      });
    }
  }

  Future<void> fetchPseudo(String authorId) async {
    final response = await http.get(Uri.parse(
        'http://docketu.iutnc.univ-lorraine.fr:27002/Sae_CMS/web/MiniPress.core/index.php/api/auteur/$authorId'));
    if (response.statusCode == 200) {
      final jsonData = json.decode(response.body);
      final pseudo = jsonData[0]['pseudo'];
      setState(() {
        authorPseudo = pseudo;
      });
    } else {
      // Gérer l'erreur de récupération du pseudo de l'auteur
      setState(() {
        authorPseudo = 'Auteur inconnu';
      });
    }
  }

  void navigateToAuthorArticles() {
    if (widget.article.author.isNotEmpty) {
      Navigator.push(
        context,
        MaterialPageRoute(
          builder: (context) => AuthorArticlesPage(
            articles: authorArticles,
            authorId: widget.article.author,
          ),
        ),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Article'),
      ),
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Padding(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    widget.article.title,
                    style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
                  ),
                  const SizedBox(height: 8),
                  GestureDetector(
                    onTap: navigateToAuthorArticles,
                    child: Text(
                      'Auteur: $authorPseudo',
                      style: const TextStyle(fontSize: 16, color: Colors.blue),
                    ),
                  ),
                  const SizedBox(height: 8),
                  Text(
                    'Date de création: ${widget.article.creationDate}',
                    style: const TextStyle(fontSize: 16),
                  ),
                  const SizedBox(height: 8),
                  Text(
                    'Date de publication: ${widget.article.publicationDate}',
                    style: const TextStyle(fontSize: 16),
                  ),
                  const SizedBox(height: 16),
                  Text(
                    widget.article.content,
                    style: const TextStyle(fontSize: 16),
                  ),
                  const SizedBox(height: 16),
                  if (categoryLabel.isNotEmpty)
                    Text(
                      'Catégorie: $categoryLabel',
                      style: const TextStyle(fontSize: 16),
                    ),
                  const SizedBox(height: 16),
                  if (widget.article.image.isNotEmpty)
                    Image.network(
                      widget.article.image,
                      fit: BoxFit.contain,
                    ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}
