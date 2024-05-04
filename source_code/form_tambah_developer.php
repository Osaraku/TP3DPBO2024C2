<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Developer.php');
include('classes/Template.php');

$developer = new Developer($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$developer->open();

$view = new Template('templates/skinform.html');

$mainTitle = 'Tambah Data Developer';
$button = 'Tambah';
$title = 'Tambah';
$link = 'form_tambah_developer.php';

$form = '
<div class="mb-3">
    <label for="developer_nama" class="form-label">Nama</label>
    <input type="text" class="form-control" id="developer_nama" name="developer_nama" required>
</div>
';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'developer_nama' => $_POST['developer_nama']
    ];

    if ($developer->addDeveloper($data) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'developer.php';
        </script>";
    } 

    else {
        echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'form_tambah_developer.php';
        </script>";
    }
}


$developer->close();
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $button);
$view->replace('DATA_FORM', $form);
$view->replace('DATA_LINK', $link);
$view->write();
