<?php
require_once("./engine/view.php");
    if(isset($_POST["ok"])){
        if( isset($_POST["username"]) &&
            isset($_POST["email"]) &&
            isset($_POST["pass"]) &&
            isset($_POST["passverify"]) && 
            $_POST["pass"] == $_POST["passverify"]
        ){
            $userData =[
                "username" => $_POST["username"],
                "email" => $_POST["email"],
                "pass" => hash("sha256", $_POST["pass"])

            ];
            View::InsertData("user", $userData);
            $result = [
                "success" => "Sikeres regisztráció"
            ];

           
        }
        else{
            $result= [
                "errorMessage" => "Nincs minden mező kitöltve!"
            ];
            
        }
    }
