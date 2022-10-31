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
        die();
    }

    $display = $mysqlConnection->prepare("DELETE FROM book WHERE author_id = :id");
    $display->bindValue(':id', $id, PDO::PARAM_INT);
    $display->execute();
    $_SESSION['message'] = "VOUS VENEZ SE SUPPRIMER UN LIVRE !";
        header('Location: new_essai.php');
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: new_essai.php');
}

?>

