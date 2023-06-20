class Category {
  final int id;
  final String libelle;
  final String description;

  Category({
    required this.id,
    required this.libelle,
    required this.description,
  });

  factory Category.fromJson(Map<String, dynamic> json) {
    return Category(
      id: json['id'] ?? 0,
      libelle: json['libelle'] ?? '',
      description: json['description'] ?? '',
    );
  }
}
