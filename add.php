<?php
$mysqlConnection = new PDO(
  'mysql:host=localhost;dbname=Library;charset=utf8',
  'root',
  ''
);
 $authors = $mysqlConnection->query('SELECT *  FROM author');


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
<h2>AJOUTER UN LIVRE</h2>  
<form  action="success.php" method="post">
    <div>
      <label for="name">Titre du livre :</label>
      <input type="text" class="form-control" id="name"  name="book_title">
    </div>
    <div>
      <label  for="release_date">Date de parution :</label>
        <input  type="date" class="form-control" id="date"  name="release_date">
    </div>
    <div>
    <label for="author_name_select">Nom de l'auteur:</label>
     <select name="author_id" class="form-control" id="authors-select">
        <option value="author_choice">--Choix de l'auteur--</option>
        <?php
          foreach ($authors as $author) {
            echo '<option value="' . $author['id'] . '">' . $author['name'] . '</option>';
          }
        ?>
      </select>
    </div>
    <input type="submit" class="btn btn-primary" value="Ajouter"/>
  </form>
 <br>
  <a href="new_essai.php" class="btn btn-primary">Voir la liste des livres</a>
</body>
</html>
