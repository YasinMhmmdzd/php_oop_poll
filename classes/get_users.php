<?php

class get_users extends connection{
    public function get_user($user_name , $user_password){
        $query = "SELECT * FROM users WHERE user_name = ? AND user_password = ?";
        $stmt = $this -> connect()-> prepare($query);
        $stmt -> execute([$user_name , $user_password]);
        return $stmt;
    }
}

?>