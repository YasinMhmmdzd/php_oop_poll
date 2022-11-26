<?php
class insert_users extends connection{
    public function insert_user($user_name , $user_fn_name , $user_email , $user_password){
        $user_role = "user";
        $query = "INSERT INTO users (user_name , user_fn_name , user_email , user_password , user_role) 
        VALUES (?,?,?,?,?)";
        $stmt = $this ->connect()-> prepare($query);
        $stmt -> execute([$user_name , $user_fn_name, $user_email , $user_password , $user_role]);
        return $stmt;
    }
}
?>