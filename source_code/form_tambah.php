<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Developer.php');
include('classes/Publisher.php');
include('classes/Games.php');
include('classes/Template.php');

$games = new Games($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$games->open();

$view = new Template('templates/skinform.html');

$mainTitle = 'Tambah Data Games';
$button = 'Tambah';
$title = 'Tambah';
$link = 'form_tambah.php';

$listdeveloper = new Developer($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listpublisher = new Publisher($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$listdeveloper->open();
$listpublisher->open();

$developers = $listdeveloper->getDeveloper();
$publishers = $listpublisher->getPublisher();

$developerOptions = '';
while ($row = $listdeveloper->getResult()) {
    $developerOptions .= '<option value="' . $row['developer_id'] . '">' . $row['developer_nama'] . '</option>';
}
$publisherOptions = '';
while ($row = $listpublisher->getResult()) {
    $publisherOptions .= '<option value="' . $row['publisher_id'] . '">' . $row['publisher_nama'] . '</option>';
}

$listdeveloper->close();
$listpublisher->close();

$form = '
<div class="mb-3">
    <label for="games_foto" class="form-label">Foto</label>
    <input type="file" class="form-control" id="games_foto" name="games_foto" accept="image/*" required>
</div>
<div class="mb-3">
    <label for="games_name" class="form-label">Nama</label>
    <input type="text" class="form-control" id="games_name" name="games_name" required>
</div>
<div class="mb-3">
    <label for="games_genre" class="form-label">Genre</label>
    <input type="text" class="form-control" id="games_genre" name="games_genre" required>
</div>
<div class="mb-3">
    <label for="games_tanggal_rilis" class="form-label">Tanggal Rilis</label>
    <input type="date" class="form-control" id="games_tanggal_rilis" name="games_tanggal_rilis" required>
</div>
<div class="mb-3">
    <label for="games_rating" class="form-label">Rating</label>
    <input type="number" class="form-control" id="games_rating" name="games_rating" required>
</div>
<div class="mb-3">
    <label for="games_harga" class="form-label">Harga</label>
    <input type="number" class="form-control" id="games_harga" name="games_harga" required>
</div>
<label for="developer_id" class="form-label">Pilih Developer</label>
<div class="mb-3">
    <select class="form-control" id="developer_id" name="developer_id" required>
    ' . $developerOptions . '
    </select>
</div>
<label for="publisher_id" class="form-label">Pilih Publisher</label>
<div class="mb-3">
    <select class="form-control" id="publisher_id" name="publisher_id" required>
    ' . $publisherOptions . '
    </select>
</div>
';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES['games_foto']['name'];
    $path = 'assets/images/' . basename($_FILES['games_foto']['name']);
    move_uploaded_file($_FILES['games_foto']['tmp_name'], $path);
    
    $data = [
        'games_name' => $_POST['games_name'],
        'games_genre' => $_POST['games_genre'],
        'games_tanggal_rilis' => $_POST['games_tanggal_rilis'],
        'games_rating' => $_POST['games_rating'],
        'games_harga' => $_POST['games_harga'],
        'developer_id' => $_POST['developer_id'],
        'publisher_id' => $_POST['publisher_id']
    ];

    if ($games->addData($data, $file) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'index.php';
        </script>";
    } 
    else {
        echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'form_tambah.php';
        </script>";
    }
}

$games->close();
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $button);
$view->replace('DATA_FORM', $form);
$view->replace('DATA_LINK', $link);
$view->write();