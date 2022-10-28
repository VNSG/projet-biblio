<?php
$mysqlConnection = new PDO(
    'mysql:host=localhost;dbname=Library;charset=utf8',
    'root',
    ''
);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateBook = $mysqlConnection->prepare('UPDATE book SET title = :title, release_date = :date, author_id = :author_id WHERE id = :id');

    $updateBook->bindValue(':title', $_POST['book_title']);
    $updateBook->bindValue(':date', $_POST['release_date']);
    $updateBook->bindValue(':author_id', $_POST['author_id']);
    $updateBook->bindValue(':id', $_GET['id']);
  
    $updateBook->execute();
}
$authors = $mysqlConnection->query('SELECT *  FROM author');
$books = $mysqlConnection->query('SELECT * from book where id = ' . $_GET['id']);
$book = $books->fetch();




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
    <h2>MODIFIER UN LIVRE</h2> 
    <form  action="modify_book.php?id=<?php echo $_GET['id']; ?>" method="post">
        <div>
        <label for="name">Titre du livre :</label>
        <input type="text"  id="name" class="form-control" name="book_title" value="<?php
        echo $book['title']; ?>">
        </div>
        <div>
            <label  for="release_date">Date de parution :</label>
            <input  type="date"  id="date" class="form-control" name="release_date" value="<?php
            echo $book['release_date']; ?>">
        </div>
        <div>
            <label for="author_name_select">Nom de l'auteur:</label>
            <select name="author_id" class="form-control" id="authors-select">
            <?php
                foreach ($authors as $author) {
                    echo '<option value="' . $author['id'] . '"';
                    if($author['id']===$book['author_id']) {
                        echo ' selected';
                    }
                    echo '>' . $author['name'];

                    //<option value="3" selected>Jean</option>
                    //<option value="3">Jean</option>
                        
                }
            ?>
            </select>
        </div>
        <div  class="button">
        <button class="btn btn-primary" type="submit">Modifier le livre</button>
        </div>
    </form>
    <br>
  <a href="new_essai.php" class="btn btn-primary">Voir la liste des livres</a>
</body>
</html>



