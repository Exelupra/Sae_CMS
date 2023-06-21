import 'package:flutter/material.dart';
import 'package:intl/intl.dart'; // Import the intl package for date formatting
import 'article.dart';

class AuthorArticlesPage extends StatelessWidget {
  final List<Article> articles;
  final String authorId;

  AuthorArticlesPage({required this.articles, required this.authorId});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Articles by Author'),
      ),
      body: ListView.builder(
        itemCount: articles.length,
        itemBuilder: (context, index) {
          Article article = articles[index];
          String formattedDate = DateFormat('yyyy-MM-dd').format(article.publicationDate); // Format the date
          return ListTile(
            title: Text(article.title),
            subtitle: Text(formattedDate), // Use the formatted date
            onTap: () {
              // Handle article tap
            },
          );
        },
      ),
    );
  }
}
