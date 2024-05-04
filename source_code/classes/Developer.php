<?php

class Developer extends DB
{
    function getDeveloper()
    {
        $query = "SELECT * FROM developer";
        return $this->execute($query);
    }

    function getDeveloperById($id)
    {
        $query = "SELECT * FROM developer WHERE developer_id=$id";
        return $this->execute($query);
    }

    function addDeveloper($data)
    {
        $developer_nama = $data['developer_nama'];
        $query = "INSERT INTO developer VALUES('', '$developer_nama')";
        return $this->executeAffected($query);
    }

    function updateDeveloper($id, $data)
    {
        $developer_nama = $data['developer_nama'];
        $query = "UPDATE developer SET developer_nama='$developer_nama' WHERE developer_id=$id";
        return $this->executeAffected($query);
    }

    function deleteDeveloper($id)
    {
        $query = "DELETE FROM developer WHERE developer_id=$id";
        return $this->executeAffected($query);
    }
}
