<?php

namespace App\Models;

use App\DataBase\DataBase;

/**
 * Method Model of DataBase request
 */
class Model extends DataBase
{
    /**
     * Name of database table
     *
     * @var string
     */
    protected $table;

    /**
     * Database instance
     *
     * @var string
     */
    private $db;

    /**
     * Find all datas of the table 
     *
     * @return void
     */
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    /**
     * Find datas with arguments ex: Where "car"."color" = red
     *
     * @param array $criteres arguments
     * @return void
     */
    public function findBy(array $criteres)
    {
        /**
         * Arguments
         * 
         * @param $champs Array with arguments
         * @var mixed
         */
        $champs = [];
        /**
         * Value of arguments
         * 
         * @param $champs Array with value
         * @var mixed
         */
        $valeurs = [];

        foreach ($criteres as $champ => $valeur) {
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        $liste_champs = implode(' AND ', $champs);

        return $this->requete("SELECT * FROM {$this->table} WHERE $liste_champs", $valeurs)->fetchAll();
    }

    /**
     * Find by an ID
     *
     * @param integer $id id of the table
     * @return void
     */
    public function find(int $id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    public function create(Model $model)
    {
        /**
         * Arguments
         * 
         * @param $champs Array with arguments
         * @var mixed
         */
        $champs = [];
        /**
         * Value of arguments
         * 
         * @param $champs Array with value
         * @var mixed
         */
        $valeurs = [];

        $inter = [];

        foreach ($model as $champ => $valeur) {

            if ($valeur !== null && $champ !== 'db' && $champ !== 'table') {

                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }

        $liste_champs = implode(' , ', $champs);
        $liste_inter = implode(' , ', $inter);

        return $this->requete('INSERT INTO '.$this->table.' ('. $liste_champs.')VALUES ('.$liste_inter.')', $valeurs)->fetchAll();
    }
    /**
     * SQL request method
     *
     * @param string $sql sql request
     * @param array|null $attributs arguments for the request
     * @return void
     */
    protected function requete(string $sql, array $attributs = null)
    {
        $this->db = DataBase::getInstance();

        if ($attributs !== null) {

            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {

            return $this->db->query($sql);
        }
    }
}
