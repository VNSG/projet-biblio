<?php
session_start();
$mysqlConnection = new PDO(
    'mysql:host=localhost;dbname=Library;charset=utf8',
    'root',
    ''
);

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $display = $mysqlConnection->prepare("SELECT b.id, title, release_date, a.name  FROM book b LEFT JOIN author a ON a.id = b.author_id WHERE author_id = :id");
    $display->bindValue(':id', $id, PDO::PARAM_INT);
    $display->execute();
    $book = $display->fetch();

    if(!$book){
        $_SESSION['erreur'] = "Cet id n'existe pas!";
        header('Location: new_essai.php');
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: new_essai.php');
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
<body><h1>Détails du livre</h1>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <p>ID <?= $book['id'] ?></p>
                <p>Titre du livre <?= $book['title'] ?></p>
                <p>Date de parution <?= $book['release_date'] ?></p>
                <p>Nom de l'auteur <?= $book['name'] ?></p>
            </section>
        </div>
        <br>
  <a href="new_essai.php" class="btn btn-primary">Retour à la liste des livres</a>
    </main>
</body>
</html>

