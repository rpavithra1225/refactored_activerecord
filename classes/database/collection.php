<?php
//namespace collections{

//use refactored_activerecord\database;

abstract class collection {
    static public function create() {
      $model = new static::$modelName;

      return $model;
    }

    static public function findAll() {

        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName;
        $statement = $db->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        $recordsSet =  $statement->fetchAll();
        return $recordsSet;
    }

    static public function findOne($id) {

        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id =' . $id;
        $statement = $db->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        $recordsSet =  $statement->fetchAll();
        if($recordsSet != null)
            return $recordsSet[0];
        else
            return $recordsSet;
    }       

    static public function printHeaders($record){
        foreach ($record as $key => $value) {
            echo "<th>".$key."</th>";
        }
    }

    static public function printAll($records){
        for($i=0;$i<count($records);$i++){
            echo "<tr>";
            foreach ($records[$i] as $key => $value) {
                echo "<td>".$value."</td>";
            } 
            echo "</tr>";
        }
        echo "</table>";
    }

    static public function printOne($record){
        echo "<tr>";
        foreach ($record as $key => $value) {
            echo "<td>".$value."</td>";
        }
        echo "</tr>";
        echo "</table>";
    }
}


?>