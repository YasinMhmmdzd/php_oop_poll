<?php
class get_users_infos extends connection{
    public function get_users_infos($user_name , $user_password){
        $query = "SELECT * FROM users WHERE user_name = ? AND user_password = ?";
        $stmt = $this -> connect()-> prepare($query);
        $stmt -> execute([$user_name , $user_password]);
        return $stmt;
    }
}
?>