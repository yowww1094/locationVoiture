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

    public function query($query, $data = array())
    {

        $stmt = $this->connect()->prepare($query);

        if($stmt){
            $check = $stmt->execute($data);
            if($check){
                $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }

        if(is_array($data) && count($data) > 0){

             // run functions after select
            if(property_exists($this, 'afterSelect')){
                foreach ($this->afterSelect as $func) {
                    # code...
                    $data  = $this->$func($data);
                }
            }
            
            return $data;
        }

        return false;
    }
}