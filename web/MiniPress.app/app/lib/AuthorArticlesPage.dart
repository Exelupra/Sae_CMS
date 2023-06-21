import 'package:flutter/material.dart';

class AuthorArticlesPage extends StatelessWidget {
  final String authorId;

  AuthorArticlesPage({required this.authorId});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Articles de l\'auteur'),
      ),
      body: Center(
        child: Text('Affichage des articles de l\'auteur avec ID : $authorId'),
      ),
    );
  }
}