<?php
$mysqlConnection = new PDO(
  'mysql:host=localhost;dbname=Library;charset=utf8',
  'root',
  ''
);

$result = "Attention, aucun livre n'a été ajouté";

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $insertion = $mysqlConnection->prepare('INSERT INTO book (title, release_date, author_id) VALUES (:title, :date, :id)');

  $insertion->bindValue(':title', $_POST['book_title']);
  $insertion->bindValue(':date', $_POST['release_date']);
  $insertion->bindValue(':id', $_POST['author_id']);

  $insertion->execute();

  $result = "Felicitations, votre livre est ajouté!";
 }

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<?php echo $result; ?>
<br>
<br>
<a href="new_essai.php" class="btn btn-primary">Voir la liste des livres</a>
</body>
</html>