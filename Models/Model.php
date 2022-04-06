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

    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        foreach ($criteres as $champ => $valeur) {
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        $liste_champs = implode(' AND ', $champs);

        return $this->requete('SELECT * FROM ' . $this->table . 'WHERE' . $liste_champs, $valeur)->fetchAll();
    }

    public function find(int $id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
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
