class Article {
  final int id;
  final String title;
  final String summary;
  final String content;
  final DateTime publicationDate;
  final DateTime creationDate;
  final String image;
  final int categoryId;
  final String author;

  Article({
    required this.id,
    required this.title,
    required this.summary,
    required this.content,
    required this.publicationDate,
    required this.creationDate,
    required this.image,
    required this.categoryId,
    required this.author,
  });

  factory Article.fromJson(Map<String, dynamic> json) {
    return Article(
      id: json['id'] ?? 0,
      title: json['titre'] ?? '',
      summary: json['resume'] ?? '',
      content: json['contenu'] ?? '',
      publicationDate: json['date_de_publication'] != null
          ? DateTime.parse(json['date_de_publication'])
          : DateTime.now(),
      creationDate: json['date_de_creation'] != null
          ? DateTime.parse(json['date_de_creation'])
          : DateTime.now(),
      image: json['image'] ?? '',
      categoryId: json['cat_id'] ?? 0,
      author: json['auteur'] ?? '',
    );
  }
}
