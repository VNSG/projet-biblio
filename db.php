<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my Library</title>
</head>
<body>
    <h1>LISTE DES LIVRES</h1>
</body>
</html>

<?php
$mysqlConnection = new PDO(
    'mysql:host=localhost;dbname=Library;charset=utf8',
    'root',
    ''
);

$books = $mysqlConnection->query('SELECT b.*, a.name  FROM book b LEFT JOIN author a ON a.id = b.author_id;');

echo '<table>';
echo '<tr><th>ID</th><th>TITRE</th><th>DATE DE SORTIE</th><th>NOM AUTEUR</th></tr>';
foreach ($books as $book) {
    echo '<tr><td>'. $book['id'] . '</td><td>' .$book['title'] . '</td><td>' .$book['release_date'] . '</td><td>' .$book['name']. '</td><td><a href="modify_book.php?id=' . $book['id'] . '">Modifier</a></td><td><a href="details.php?id=' . $book['id'] . '">Détails</a></td></tr>';
}
echo '</table>','<br></br>';

echo '<a href="add.php">Ajouter Un livre</a>','<br></br>';
?>

