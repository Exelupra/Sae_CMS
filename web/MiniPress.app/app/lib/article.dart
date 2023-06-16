import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:flutter_html/flutter_html.dart';
import 'dart:convert';

class Article {

Future<Map<String, dynamic>> fetchData() async {
  String apiUrl = ''; 
  http.Response response = await http.get(Uri.parse(apiUrl));

  if (response.statusCode == 200) {
    return json.decode(response.body);
  } else {
    throw Exception('Erreur lors du chargement des données');
  }
}

}