<?php

class Model{
    private static mysqli $conn;

    public static function Connect(){
        try{
            self::$conn = new mysqli("localhost", "admin2", "password", "szamla");
        }
        catch(Exceotion $e){
            throw new Exception("Sikertelen csatlakozás az adatbázishoz.");
        }
    }

    public static function Disconnect(){
        try{
            self::$conn->close();
        }
        catch(Exception $e){
            throw new Exception("Sikertelen lecsatlakozás az adatbázisról.");
        }
    }

    public static function InsertToSzamla(array $data){
        self::Connect();

            try{
                $sql = "INSERT INTO `szamlaadatok` (`user_id`, `nyugta`, `szamla`, `vevoneve`, `bevosszeg`, `kifizdatum`) VALUES ($data[userid], '$data[nyugta]', '$data[szamla]', '$data[vevoneve]', $data[bevosszeg], '$data[kifizdatum]');";
                self::$conn->query($sql);
            }
            catch(Exception $e){
                throw new Exception("Sikertelen Felvitel");
            }
        
        
        self::Disconnect();
    }

    public static function InsertToUsers(array $data){
        self::Connect();

            try{
                $sql = "INSERT INTO `users` ( `username`, `email`, `pass`) VALUES ( '$data[username]', '$data[email]', '$data[pass]');";
                self::$conn->query($sql);
            }
            catch(Exception $e){
                throw new Exception("Sikertelen Felvitel");
            }
        
        
        self::Disconnect();
    }

    public static function GetAllData( $id, $orderBy = 'szamla'){
        self::Connect();
        try{
            $sql = "SELECT * FROM `szamlaadatok` WHERE `user_id` = '$id' ORDER BY `$orderBy` DESC;";
            $result = self::$conn->query($sql);
            //$jsonformat = json_encode($result->fetch_all(MYSQLI_ASSOC));
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        catch(Exception $e){
            throw new Exception("Sikertelen lekérdeés");
        }
        self::Disconnect();
    }

    public static function Delete($id){
        self::Connect();
        try{
            $sql = "DELETE FROM `szamlaadatok` WHERE `id` = $id;";
            self::$conn->query($sql);
        }
        catch(Exception $e){
            throw new Excepton("sikertelen törlés");
        }
    }

    public static function login($data, $rememberMe = false){
        self::Connect();
        try{
            $sql = "SELECT * FROM `users` WHERE `username` = '$data[username]'";
            $result = self::$conn->query($sql);
            $user = $result->fetch_assoc();
            
            if($user["pass"] == $data["pass"]){

               
                    $_SESSION["userid"] = $user["id"];
                    $_SESSION["username"] = $user["username"];
                    header("location: index.php?userid=".$_SESSION["userid"]);
                
                
                
                
            }
        }
        catch(Exception $e){
            throw new Exception("Sikertelen lekérdezés", $e);
        }   
        self::Disconnect();
    }

    public static function changePass($data){
        self::Connect();

        try{
            $sql = "UPDATE `users` SET `pass` = '$data[newpass1]' WHERE `id` = $data[userid];";
            self::$conn->query($sql);
        }
        catch(Exception $e){
            throw new Exception("Sikertelen mődosítás", $e);
        }
        self::Disconnect();
    }

    public static function changeUsername($data){
        self::Connect();

        try{
            $sql = "UPDATE `users` SET `username` = '$data[newUsername]' WHERE `id` = $data[userid];";
            self::$conn->query($sql);
            $_SESSION["username"] = "$data[newUsername]";
        }
        catch(Exception $e){
            throw new Exception("Sikertelen módosítás", $e);
        }

        self::Disconnect();
    }



}