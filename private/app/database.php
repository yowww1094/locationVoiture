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
}