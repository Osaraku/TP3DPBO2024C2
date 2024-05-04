<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Games.php');

$games = new Games($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$games->open();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $games->deleteData($id);
    } else {
        echo "ID tidak valid.";
    }
}

$games->close();

header("Location: index.php");
exit();
?>