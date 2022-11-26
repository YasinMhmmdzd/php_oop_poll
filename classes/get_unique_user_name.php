<?php
class unique_user extends connection{
    public function unique_user(){
        $query = "SELECT * FROM users";
        $stmt = $this -> connect()-> query($query);
        return $stmt;
    }
}
?>