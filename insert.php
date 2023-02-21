<?php
    require_once("./engine/view.php");
    session_start();

    if(isset($_POST["ok"])){
        if(isset($_POST["nyugtasorszam"]) && isset($_POST["szamlasorszam"]) && isset($_POST["vevoneve"]) && isset($_POST["bevetel"]) && isset($_POST["fizetesdatum"])){
            $data = [
                "nyugta" => $_POST["nyugtasorszam"],
                "szamla" => $_POST["szamlasorszam"],
                "vevoneve" => $_POST["vevoneve"],
                "bevosszeg" => $_POST["bevetel"],
                "kifizdatum" => $_POST["fizetesdatum"],
                "userid" => $_SESSION["userid"]
            ];
            $id = $_SESSION["userid"];
            View::InsertData("szamla", $data);

        }
        else{
            print("<h2>Kérem adja meg az adatokat</h2>");
        }
    }
    else{
        print("valami nem jo");
    }
    header("Location: index.php");
?>