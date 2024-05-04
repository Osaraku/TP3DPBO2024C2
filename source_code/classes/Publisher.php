<?php

class Publisher extends DB
{
    function getPublisher()
    {
        $query = "SELECT * FROM publisher";
        return $this->execute($query);
    }

    function getPublisherById($id)
    {
        $query = "SELECT * FROM publisher WHERE publisher_id=$id";
        return $this->execute($query);
    }

    function addPublisher($data)
    {
        $publisher_nama = $data['publisher_nama'];
        $query = "INSERT INTO publisher VALUES('', '$publisher_nama')";
        return $this->executeAffected($query);
    }

    function updatePublisher($id, $data)
    {
        $publisher_nama = $data['publisher_nama'];
        $query = "UPDATE publisher SET publisher_nama='$publisher_nama' WHERE publisher_id=$id";
        return $this->executeAffected($query);
    }

    function deletePublisher($id)
    {
        $query = "DELETE FROM publisher WHERE publisher_id=$id";
        return $this->executeAffected($query);
    }
}
