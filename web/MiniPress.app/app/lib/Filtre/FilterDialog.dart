import 'package:flutter/material.dart';

class FilterDialog extends StatefulWidget {
  const FilterDialog({super.key});

  @override
  _FilterDialogState createState() => _FilterDialogState();
}

class _FilterDialogState extends State<FilterDialog> {
  final TextEditingController _textEditingController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: const Text('Filtrer par mot-clé'),
      content: TextField(
        controller: _textEditingController,
        decoration: const InputDecoration(
          hintText: 'Entrez un mot-clé',
        ),
      ),
      actions: [
        TextButton(
          child: const Text('Annuler'),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
        TextButton(
          child: const Text('Filtrer'),
          onPressed: () {
            final keyword = _textEditingController.text;
            Navigator.pop(context, keyword);
          },
        ),
      ],
    );
  }
}