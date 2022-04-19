<?php

// main model class

class Model extends database{

    public $errors = array();
    
    public function __construct(){

        if(!property_exists($this, 'table')){
            $this->table = strtolower($this::class) . "s";
        }
    }

    public function where($column, $value){
        $query = "select * from $this->table where $column = :value";

        return $this->query($query, [
            'value' => $value
        ]);
    }

    public function findAll(){
        $query = "select * from $this->table";

        return $this->query($query);
    }

    public function insert($data){

        // remove unwanted columns
        if(property_exists($this, 'allowedColumns')){
            foreach ($this->beforeInsert as $key => $column) {
                # code...
                if (in_array($key, $this->allowedColumns)) {
                    # code...
                    unset($data[$key]);
                }
            }
        }

        // run functions before insert
        if(property_exists($this, 'beforeInsert')){
            foreach ($this->beforeInsert as $func) {
                # code...
                $data  = $this->$func($data);
            }
        }

        $keys = array_keys($data);
        $columns = implode(",", $keys);
        $values = implode(',:', $keys);

        $query = "insert into $this->table ($columns) values (:$values)";

        return $this->query($query, $data);
    }

    public function update($id, $data){

        $str = "";
        foreach($data as $key => $val){
            $str .= $key . "=:" . $key . ",";
        }
        $str = trim($str, ",");
        
        $data['id'] = $id;
        $query = "update  $this->table set $str where id = :id";
        echo $query;
        return $this->query($query, $data);
    }

    public function delete($id){

        $query = "delete from $this->table where id = :id";

        $data['id'] = $id;
        return $this->query($query, $data);
    }
}