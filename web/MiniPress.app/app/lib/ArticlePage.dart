import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'article.dart';
import 'dart:convert';
import 'AuthorArticlesPage.dart';
class ArticlePage extends StatefulWidget {
  final Article article;

  ArticlePage({required this.article});

  @override
  _ArticlePageState createState() => _ArticlePageState();
}

class _ArticlePageState extends State<ArticlePage> {
  String categoryLabel = '';
  String authorId = '';

  @override
  void initState() {
    super.initState();
    fetchCategoryLabel();
    extractAuthorId();
  }

  Future<void> fetchCategoryLabel() async {
    final response = await http.get(Uri.parse('http://docketu.iutnc.univ-lorraine.fr:27002/Sae_CMS/web/MiniPress.core/index.php/api/categorie/${widget.article.categoryId}'));
    if (response.statusCode == 200) {
      final jsonData = json.decode(response.body);
      setState(() {
        categoryLabel = jsonData['libelle'];
      });
    } else {
      // Gestion des erreurs
    }
  }

  void extractAuthorId() {
    final regex = RegExp(r'/auteurs/([^/]+)/');
    final match = regex.firstMatch(widget.article.author);
    if (match != null && match.groupCount >= 1) {
      setState(() {
        authorId = match.group(1)!;
      });
    }
  }

  void navigateToAuthorArticles() {
    if (authorId.isNotEmpty) {
      Navigator.push(
        context,
        MaterialPageRoute(
          builder: (context) => AuthorArticlesPage(authorId: authorId),
        ),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Article'),
      ),
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Padding(
              padding: EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    widget.article.title,
                    style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
                  ),
                  SizedBox(height: 8),
                  GestureDetector(
                    onTap: navigateToAuthorArticles,
                    child: Text(
                      'Auteur: ${widget.article.author}',
                      style: TextStyle(fontSize: 16, color: Colors.blue),
                    ),
                  ),
                  SizedBox(height: 8),
                  Text(
                    'Date de création: ${widget.article.creationDate}',
                    style: TextStyle(fontSize: 16),
                  ),
                  SizedBox(height: 8),
                  Text(
                    'Date de publication: ${widget.article.publicationDate}',
                    style: TextStyle(fontSize: 16),
                  ),
                  SizedBox(height: 16),
                  Text(
                    widget.article.content,
                    style: TextStyle(fontSize: 16),
                  ),
                  SizedBox(height: 16),
                  if (categoryLabel.isNotEmpty)
                    Text(
                      'Catégorie: $categoryLabel',
                      style: TextStyle(fontSize: 16),
                    ),
                  SizedBox(height: 16),
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