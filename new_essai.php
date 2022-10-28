<?php
$mysqlConnection = new PDO(
    'mysql:host=localhost;dbname=Library;charset=utf8',
    'root',
    ''
);

$books = $mysqlConnection->query('SELECT b.*, a.name  FROM book b LEFT JOIN author a ON a.id = b.author_id;');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my Library</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <h1>LISTE DES LIVRES</h1>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>DATE DE SORTIE</th>
                        <th>NOM DE L'AUTEUR</th>
                        <th>ACTIONS</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($books as $book) {
                        ?>
                            <tr>
                                <td><?= $book['id'] ?></td>
                                <td><?= $book['title'] ?></td>
                                <td><?= $book['release_date'] ?></td>
                                <td><?= $book['name'] ?></td>
                                <td><a style="margin-right:2%" href="details.php?id=<?= $book['id'] ?>"> Voir plus</a><a style="margin-left:2%" href="modify_book.php?id=<?= $book['id'] ?>"> Modifier</a><a style="margin-left:2%" href="delete_book.php?id=<?= $book['id'] ?>"> Supprimer</a></td>
                            </tr>
                    <?php
                    }
                    ?>



                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter un livre</a>
            </section>  
        </div>
    </main>
</body>
</html>