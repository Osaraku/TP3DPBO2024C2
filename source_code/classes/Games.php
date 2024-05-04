<?php

class Games extends DB
{
    function getGamesJoin()
    {
        $query = "SELECT * FROM games JOIN developer ON games.developer_id=developer.developer_id JOIN publisher ON games.publisher_id=publisher.publisher_id ORDER BY games.games_id";

        return $this->execute($query);
    }

    function getGames()
    {
        $query = "SELECT * FROM games";
        return $this->execute($query);
    }

    function getGamesById($id)
    {
        $query = "SELECT * FROM games JOIN developer ON games.developer_id=developer.developer_id JOIN publisher ON games.publisher_id=publisher.publisher_id WHERE games_id=$id";
        return $this->execute($query);
    }

    function searchGames($keyword)
    {
        $query = "SELECT * FROM games 
        JOIN developer ON games.developer_id=developer.developer_id 
        JOIN publisher ON games.publisher_id=publisher.publisher_id 
        WHERE games.games_nama LIKE '%$keyword%'";

        return $this->execute($query);
    }

    function addData($data, $file)
    {
        function addData($data, $file)
        {
            $games_foto = $file;
            $games_nama = $data['games_nama'];
            $games_genre = $data['games_genre'];
            $games_tanggal_rilis = $data['games_tanggal_rilis'];
            $games_rating = $data['games_rating'];
            $games_harga = $data['games_harga'];
            $developer_id = $data['developer_id'];
            $publisher_id = $data['publisher_id'];

            $query = "INSERT INTO games VALUES ('', '$games_foto', '$games_nama', '$games_genre', '$games_tanggal_rilis', '$games_rating', '$games_harga', '$developer_id', '$publisher_id')";

            return $this->executeAffected($query);
        }
    }

    function updateData($id, $data, $file)
    {
            $games_foto = $data['games_foto'];
            $games_nama = $data['games_nama'];
            $games_genre = $data['games_genre'];
            $games_tanggal_rilis = $data['games_tanggal_rilis'];
            $games_rating = $data['games_rating'];
            $games_harga = $data['games_harga'];
            $developer_id = $data['developer_id'];
            $publisher_id = $data['publisher_id'];
    
        $query = "UPDATE games SET
                    games_foto = '$games_foto',
                    games_nama = '$games_nama',
                    games_genre = '$games_genre',
                    games_tanggal_rilis = '$games_tanggal_rilis',
                    games_rating = '$games_rating',
                    games_harga = '$games_harga',
                    developer_id = '$developer_id',
                    publisher_id = '$publisher_id'
                    WHERE games_id = '$id'";

        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM games WHERE games_id='$id'";
        $this->executeAffected($query);
    }
}
