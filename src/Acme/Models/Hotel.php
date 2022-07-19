<?php
namespace Acme\Models;
use Acme\Adapter\MysqlAdapter;

class Hotel extends MysqlAdapter
{
    private $table = 'hotels';
    public function __construct()
    {
        global $config;
        parent::__construct($config);
    }

    public function getHotels()
    {
         $this->select($this->table);
        return $this->fetchAll();
    }
    public function searchHotels($keyword){
        $this->select($this->table,"name Like '%$keyword%'");
        return $this->fetchAll();
    }

}