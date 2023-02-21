<?php
    require_once("control.php");
    abstract class View{
        public static function InsertData($falg, $userData){
            Control::InsertDataTo($falg, $userData);
        }

        public static function login($data, $rememberMe = false){
            Control::login($data, $rememberMe);
        }

        public static function logout(){
            Control::logout();
        }

        public static function changePass($data){
            Control::Update($data);
        }

        public static function changeUsername($data){
            Control::Update($data);
        }
    }