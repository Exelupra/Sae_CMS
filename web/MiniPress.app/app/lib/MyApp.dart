import 'package:flutter/material.dart';
import 'HomePage.dart';
class MyApp extends StatelessWidget {
@override
Widget build(BuildContext context) {
  return MaterialApp(
    title: 'MiniPress App',
    theme: ThemeData(
      primarySwatch: Colors.blue,
    ),
    home: HomePage(),
  );
}
}