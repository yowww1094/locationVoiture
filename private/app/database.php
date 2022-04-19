<?php

class database{
    public function connect(){
        try{
            $con = new PDO(DBTYPE.':host='.HOST.';dbname='.DBNAME,USER,PASS);
            //echo 'connection success!';
        }
        catch (PDOException $e){
            die('Error!: '. $e->getMessage());
        }

        return $con;
    }

    public function query($query, $data = array()){
        $stmt = $this->connect()->prepare($query);

        if($stmt){
            $check = $stmt->execute($data);
            if($check){
                $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }

        if(is_array($data) && count($data) > 0){
            return $data;
        }

        return false;
    }

    /*public function selectAll(){
        $query = "Select * from '$this->table'";

        return $this->query($query);
    }

    public function selectSingle($table){
        $stmt = $this->connect()->prepare("Select * from $table limit 1");
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_OBJ);

        if(is_array($data) && count($data) > 0){
            return $data;
        }

        return false;
    }

    /*public function where($table, $column, $condition){
        $stmt = $this->connect()->prepare("SELECT * from '$table' where '$column'= :condition");
        $stmt->execute(['condition' => $condition]);

        if($stmt){
            $res = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $res;
        }else{
            return false;
        }
    }

    /*public function insert($table, $data = array()){
        $stmt = $this->connect()->prepare("INSERT INTO $table (name) VALUES (   )");
        $stmt->execute($data);
        
        if(!$stmt){
            return false;
        }
        return true;
    }*/
}