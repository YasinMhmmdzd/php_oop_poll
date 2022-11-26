<?php
class get_poll extends connection{
    public function get_poll(){
        $query = "SELECT * FROM poll";
        $stmt = $this -> connect() -> query($query);
        return $stmt;
    }
}
?>