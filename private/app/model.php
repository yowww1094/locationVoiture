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

        $data = $this->query($query, [
            'value' => $value
        ]);

        // run functions after select
        if(property_exists($this, 'afterSelect')){
            foreach ($this->afterSelect as $func) {
                # code...
                $data  = $this->$func($data);
            }
        }

        return $data;
    }

    public function findAll(){
        $query = "select * from $this->table";

        $data = $this->query($query);

        // run functions after select
        if(property_exists($this, 'afterSelect')){
            foreach ($this->afterSelect as $func) {
                # code...
                $data  = $this->$func($data);
            }
        }

        return $data;
    }

    public function orderBy($column, $order = 'ASC'){
        $query = "select * from $this->table order by $column $order";

        $data = $this->query($query);

        // run functions after select
        if(property_exists($this, 'afterSelect')){
            foreach ($this->afterSelect as $func) {
                # code...
                $data  = $this->$func($data);
            }
        }

        return $data;
    }

    public function insert($data){

        // remove unwanted columns
        if(property_exists($this, 'allowedColumns')){

            foreach ($data as $key => $column) {
                # code...
                if (!in_array($key, $this->allowedColumns)) {
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

    public function update($column, $value, $data){

        $str = "";
        foreach($data as $key => $val){
            $str .= $key . "=:" . $key . ",";
        }
        $str = trim($str, ",");
        
        $data['value'] = $value;
        $query = "update  $this->table set $str where $column = :value";

        return $this->query($query, $data);
    }

    public function delete($id){

        $query = "delete from $this->table where id = :id";

        $data['id'] = $id;
        return $this->query($query, $data);
    }
}