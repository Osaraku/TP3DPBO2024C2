<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Developer.php');
include('classes/Publisher.php');
include('classes/Games.php');
include('classes/Template.php');

// buat instance games
$listGames = new Games($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listGames->open();
// tampilkan data games
$listGames->getGamesJoin();

// cari games
if (isset($_POST['btn-cari'])) {
    // methode mencari data games
    $listGames->searchGames($_POST['cari']);
} else {
    // method menampilkan data games
    $listGames->getGamesJoin();
}

$data = null;

// ambil data games
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listGames->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 games-thumbnail">
        <a href="detail.php?id=' . $row['games_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['games_foto'] . '" class="card-img-top" alt="' . $row['games_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text games-nama my-0">' . $row['games_nama'] . '</p>
                <p class="card-text developer-nama my-0">' . $row['developer_nama'] . "  |  " . $row['publisher_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listGames->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_GAMES', $data);
$home->write();
