<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Publisher.php');
include('classes/Template.php');

$publisher = new Publisher($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$publisher->open();

$view = new Template('templates/skinform.html');

$mainTitle = 'Tambah Data Publisher';
$button = 'Tambah';
$title = 'Tambah';
$link = 'form_tambah_publisher.php';

$form = '
<div class="mb-3">
    <label for="publisher_nama" class="form-label">Nama</label>
    <input type="text" class="form-control" id="publisher_nama" name="publisher_nama" required>
</div>
';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'publisher_nama' => $_POST['publisher_nama']
    ];

    if ($publisher->addPublisher($data) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'publisher.php';
        </script>";
    } 

    else {
        echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'form_tambah_publisher.php';
        </script>";
    }
}


$publisher->close();
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $button);
$view->replace('DATA_FORM', $form);
$view->replace('DATA_LINK', $link);
$view->write();
