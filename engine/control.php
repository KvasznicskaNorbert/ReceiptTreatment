<?php
    require_once("model.php");
    abstract class Control{
        public static function InsertDataTo($flag, $data){
            if($flag == "user"){
                Model::InsertToUsers($data);
            }
            elseif($flag == "szamla"){
                Model::InsertToSzamla($data);
            }
        }

        public static function login($data, $rememberMe = false){
            Model::login($data, $rememberMe);
        }

        public static function logout(){
            Model::logout();
        }

        public static function Update($data){
            $method = $data["update"];
            Model::$method($data);
        }
    }   