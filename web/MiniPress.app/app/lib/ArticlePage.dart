import 'package:flutter/material.dart';
import 'article.dart';

class ArticlePage extends StatelessWidget {
  final Article article;

  ArticlePage({required this.article});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Article'),
      ),
      body: Padding(
        padding: EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              article.title,
              style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
            ),
            SizedBox(height: 8),
            Text(
              'Auteur: ${article.author}',
              style: TextStyle(fontSize: 16),
            ),
            SizedBox(height: 8),
            Text(
              'Date de création: ${article.creationDate}',
              style: TextStyle(fontSize: 16),
            ),
            SizedBox(height: 16),
            Text(
              article.content,
              style: TextStyle(fontSize: 16),
            ),
          ],
        ),
      ),
    );
  }
}
