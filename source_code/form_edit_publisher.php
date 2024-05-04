<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Publisher.php');
include('classes/Template.php');

$publisher = new Publisher($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$publisher->open();

$view = new Template('templates/skinform.html');

$mainTitle = 'Edit Data Publisher';
$button = 'Simpan';
$title = 'Edit';
$link = 'form_edit_publisher.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $publisher->getPublisherById($id);
        $row = $publisher->getResult();
        $editData = $row['publisher_nama'];

        $form = '
        <input type="hidden" name="id" value="' . $id . '">
        <div class="mb-3">
            <label for="publisher_nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="publisher_nama" name="publisher_nama" value="' . $editData . '" required>
        </div>
        ';

        $view->replace('DATA_VAL_UPDATE', $editData);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'publisher_nama' => $_POST['publisher_nama']
    ];

    if ($publisher->updatePublisher($_POST['id'], $data) > 0) {
        echo "<script>
            alert('Data berhasil diedit!');
            document.location.href = 'publisher.php';
        </script>";
    } 

    else {
        echo "<script>
            alert('Data gagal diedit!');
            document.location.href = 'form_edit_publisher.php';
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
