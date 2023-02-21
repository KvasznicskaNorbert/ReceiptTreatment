<?php
require_once("./engine/model.php");
if(isset($_POST["delete"])){
    Model::Delete($_POST["id"]);
}
header("Location: index.php");