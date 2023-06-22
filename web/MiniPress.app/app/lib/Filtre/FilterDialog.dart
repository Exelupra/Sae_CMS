import 'package:flutter/material.dart';

class FilterDialog extends StatefulWidget {
  @override
  _FilterDialogState createState() => _FilterDialogState();
}

class _FilterDialogState extends State<FilterDialog> {
  TextEditingController _textEditingController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: Text('Filtrer par mot-clé'),
      content: TextField(
        controller: _textEditingController,
        decoration: InputDecoration(
          hintText: 'Entrez un mot-clé',
        ),
      ),
      actions: [
        TextButton(
          child: Text('Annuler'),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
        TextButton(
          child: Text('Filtrer'),
          onPressed: () {
            final keyword = _textEditingController.text;
            Navigator.pop(context, keyword);
          },
        ),
      ],
    );
  }
}