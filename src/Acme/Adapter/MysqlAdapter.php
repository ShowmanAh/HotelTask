<?php
namespace Acme\Adapter;
use http\Exception\InvalidArgumentException;
use http\Exception\RuntimeException;

require 'DB_config.php';
class MysqlAdapter
{
    protected $_config = array();
    protected $link;
    protected $result;
    public function __construct(array $config)
    {
        if(count($config) !== 4){
            throw new \InvalidArgumentException("invalid parameters");
        }
        $this->_config = $config;
    }


    public function connect(){
        //Singletone connect only once
        if($this->link === null){
            list($host, $user, $password, $database) = $this->_config;
            if(!$this->link = mysqli_connect($host, $user, $password, $database)){
                throw new RuntimeException('Error connecting with server : ' . mysqli_connect_error());

            }
            unset($host, $user, $password, $database);

        }

        return $this->link;
    }
    public function query($query){
        if(!is_string($query) || empty($query)){
            throw new InvalidArgumentException('The specified query is not valid');
        }
        //Lazy connect to mysql connection when query executed
        $this->connect();
        if (!$this->result = mysqli_query($this->link, $query)){
            throw new RuntimeException('Error Executing the specified query' . $query . mysqli_error($this->link));
        }

        return $this->result;

    }

    public function select($table, $where = '', $fields = '*', $order = '', $limit = null, $offset = null){
        $query = 'select'  . ' '. $fields . ' ' . 'from' . ' ' . $table
            . (($where) ?  'WHERE' . $where  :  '')
            . (($limit) ? 'LIMIT' . $limit : '')
            . (($limit && $offset) ? 'OFFSET' .  $offset :  '')
            . (($order)  ? 'ORDER BY' . $order  :  '');
       $this->result = $this->query($query);

        return $this->countRows();

    }

    // function fetch all row  from current result set as (associative array)
    public function fetchAll(){
        if($this->result !== null){
            $all = mysqli_fetch_all($this->result, MYSQLI_ASSOC);
            if(!$all){
                $this->freeResult();
            }
            return $all;

        }
        return false;
    }

    public function countRows(){
        return $this->result !== null ? mysqli_num_rows($this->result) : 0;
    }

    public function freeResult(){
        if($this->result === null){
            return false;
        }
        mysqli_free_result($this->result);

        return true;
    }

    public function disconnect(){
        if ($this->link === null){
            return false;
        }
        mysqli_close($this->link);
        $this->link = null;

        return true;

    }
    // close db connection automatically when instance of class destroyed
    public function __destruct()
    {
        $this->disconnect();
    }
}