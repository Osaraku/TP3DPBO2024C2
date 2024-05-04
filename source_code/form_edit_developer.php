<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Developer.php');
include('classes/Template.php');

$developer = new Developer($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$developer->open();

$view = new Template('templates/skinform.html');

$mainTitle = 'Edit Data Developer';
$button = 'Simpan';
$title = 'Edit';
$link = 'form_edit_developer.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $developer->getDeveloperById($id);
        $row = $developer->getResult();
        $editData = $row['developer_nama'];

        $form = '
        <input type="hidden" name="id" value="' . $id . '">
        <div class="mb-3">
            <label for="developer_nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="developer_nama" name="developer_nama" value="' . $editData . '" required>
        </div>
        ';

        $view->replace('DATA_VAL_UPDATE', $editData);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'developer_nama' => $_POST['developer_nama']
    ];

    if ($developer->updateDeveloper($_POST['id'], $data) > 0) {
        echo "<script>
            alert('Data berhasil diedit!');
            document.location.href = 'developer.php';
        </script>";
    } 

    else {
        echo "<script>
            alert('Data gagal diedit!');
            document.location.href = 'form_edit_developer.php';
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
