<?php
class inset_poll extends connection{
    public function insert_poll($poll_answer , $poll_user){
        $query = "INSERT INTO poll (poll_answer , poll_user) VALUES (? , ?)";
        $stmt = $this -> connect()->prepare($query);
        $stmt -> execute([$poll_answer , $poll_user]);
        return $stmt;
    }
}
?>