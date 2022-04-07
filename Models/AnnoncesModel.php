<?php

namespace App\Models;

class AnnoncesModel extends Model
{
    protected $id;
    protected $titre;
    protected $description;
    protected $created_at;
    protected $active;

    public function __construct()
    {

        $this->table = 'annonces';
    }
}
