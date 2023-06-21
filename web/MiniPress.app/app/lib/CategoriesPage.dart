
import 'package:flutter/material.dart';
import 'categorie.dart';
import 'CategoryArticlesPage.dart';



class CategoriesPage extends StatelessWidget {
  final List<Category> categories;

  const CategoriesPage({Key? key, required this.categories}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Categories'),
      ),
      body: ListView.builder(
        itemCount: categories.length,
        itemBuilder: (context, index) {
          final category = categories[index];
          return ListTile(
            title: Text(category.libelle),
            subtitle: Text(category.description),
            onTap: () {
               Navigator.push(context,MaterialPageRoute(builder: (context) => CategoryArticlesPage(categoryId: category.id),
                 ),
              );
            },
          );
        },
      ),
    );
  }
}
