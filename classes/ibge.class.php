<?php

class ibge {

    private $conn;
    public $retorno;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar($table, $join, $cpoSelect, $cpoKey, $cpoGroupBy, $cpoOrderBy) {

         $querySql = "SELECT ". $cpoSelect ." FROM ". $table;
         if ($join){
             $querySql .= " JOIN ". $join;
         }
         if ($cpoKey){
             $querySql .= " WHERE ". $cpoKey;
         }
         if ($groupBy){
             $querySql .= " GROUP BY ". $groupBy;
         }
         if ($orderBy){
             $querySql .= " ORDER BY ". $orderBy;
         }

         $stmt = $this->conn->prepare( $querySql );
         $stmt->execute();
 
         return $stmt;
    }
}

?>