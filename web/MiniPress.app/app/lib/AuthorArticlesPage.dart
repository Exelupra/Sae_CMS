import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'article.dart';
import 'ArticlePage.dart';

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

          String formattedDate =
          DateFormat('yyyy-MM-dd').format(article.publicationDate);
          return ListTile(
            title: Text(article.title),
            subtitle: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(formattedDate),
                Text(article.summary),
              ],
            ),
            onTap: () {
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
