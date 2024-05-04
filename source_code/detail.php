<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Developer.php');
include('classes/Publisher.php');
include('classes/Games.php');
include('classes/Template.php');

$games = new Games($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$games->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $games->getGamesById($id);
        $row = $games->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['games_nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['games_foto'] . '" class="img-thumbnail" alt="' . $row['games_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['games_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Genre</td>
                                    <td>:</td>
                                    <td>' . $row['games_genre'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Rilis</td>
                                    <td>:</td>
                                    <td>' . $row['games_tanggal_rilis'] . '</td>
                                </tr>
                                <tr>
                                    <td>Rating</td>
                                    <td>:</td>
                                    <td>' . $row['games_rating'] . '</td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td>' . $row['games_harga'] . '</td>
                                </tr>
                                <tr>
                                    <td>Developer</td>
                                    <td>:</td>
                                    <td>' . $row['developer_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Publisher</td>
                                    <td>:</td>
                                    <td>' . $row['publisher_nama'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="#"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="hapus_games.php?id=' . $id . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

$games->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_GAMES', $data);
$detail->write();
