<?php

namespace App\Models;

use App\DataBase\DataBase;

class Model extends DataBase
{
    protected $table;

    private $db;

    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    protected function requete(string $sql, array $attributs = null)
    {
        $this->db = DataBase::getInstance();

        if ($attributs !== null) {

            $query = $this->DataBase->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {

            return $this->db->query($sql);
        }
    }
}
