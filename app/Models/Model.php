<?php
namespace App\Models;

use PDO;
use DataBase\Db;

abstract class Model{

        protected $db;
        protected $table;

        public function __construct(Db $db){
            $this-> db = $db;
             
        } 

        public function all(): array {
            // $stmt= $this->db->getPDO()->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
            // $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
            // return $stmt->fetchAll();
            return $this->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");


        }
    
        public function findById(int $id): Model{
            // $stmt = $this->db->getPDO()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            // $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
            // $stmt->execute([$id]);
            // return $stmt->fetch();
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);

        }
        public function query(string $sql, array $param = null, bool $single = null){

            $method = is_null($param) ? 'query' : 'prepare';
    
            $fetch = is_null($single) ? 'fetchAll' : 'fetch';
    
            $stmt = $this->db->getPDO()->$method($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
    
            if ($method === 'query') {
                return $stmt->$fetch();
            } else {
                $stmt->execute($param);
                return $stmt->$fetch();
            }
        }
}