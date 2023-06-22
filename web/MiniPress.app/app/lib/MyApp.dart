import 'package:flutter/material.dart';
import 'Page/HomePage.dart';
class MyApp extends StatelessWidget {
@override
Widget build(BuildContext context) {
  return MaterialApp(
    debugShowCheckedModeBanner: false,
    title: 'MiniPress App',
    theme: ThemeData(
      primarySwatch: Colors.blue,
    ),
    home: HomePage(),
  );
}
}