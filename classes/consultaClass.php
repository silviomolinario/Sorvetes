<?php

class ConsultaClass {

    private $conn;
    public $retorno;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    public function consultar($table, $join, $cpoSelect, $cpoKey, $cpoGroupBy, $cpoOrderBy) {

         $querySql = "SELECT ". $cpoSelect ." FROM ". $table;
         if ($join){
             $querySql .= " JOIN ". $join;
         }
         if ($cpoKey){
             $querySql .= " WHERE ". $cpoKey;
         }
         if ($cpoGroupBy){
             $querySql .= " GROUP BY ". $cpoGroupBy;
         }
         if ($cpoOrderBy){
             $querySql .= " ORDER BY ". $cpoOrderBy;
         }
         $querySql .= ";";

         $stmt = $this->conn->prepare( $querySql );
         $stmt->execute();
         
         return $stmt;
    }
}

?>