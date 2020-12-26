<?php


require_once "../dbconnect.php";

class UserLogic
{
/**
 * @param array $userData
 * @return bool $result
 */
public static function createUser($userData)
{
    $result = false;

    $sql = "INSERT INTO users (name, email,
    password) VALUES (?, ?, ?)";

    $arr =[];
    $arr[] = $userData["username"];
    $arr[] = $userData["email"];
    $arr[] = password_hash($userData["password"],
    PASSWORD_DEFAULT);

    try{
        $stmt = connect()->prepare($sql);
        $result = $stmt->execute($arr);
        return $result;    
    } catch(\Exception $e){
        return $result;
    }

}
/**
 * @param string $email
 * @return string $password
 * @return bool $result
 */
public static function login($email, $password)
 {
     $result = false;

     $user = self::getUserByEmail($email);
    if(!$user){
        $_SESSION["msg"] = "emailが一致しません";
        return $result;
    }

    if (password_verify($password, $user["password"])){
      session_regenerate_id(true);
      $_SESSION["login_user"] = $user;
      $result = true;
      return $result;  
    }

    $_SESSION["msg"] = "パスワードが一致しません";
        return $result;
 }

 /**
 * @param string $email
 * @return array|bool $result
 */
public static function getUserByEmail($email)
 {
     $sql ="SELECT * FROM users WHERE email = ?";
    $arr = [];
    $arr[] = $email;
    

    try{
        $stmt = connect()->prepare($sql);
        $stmt->execute($arr);
        $user = $stmt->fetch();
        return $user;    
    } catch(\Exception $e){
        return false;
    }
 }
}
?>