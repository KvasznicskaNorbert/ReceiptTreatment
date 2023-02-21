<?php
require_once("./engine/model.php");
header("Content-type: application/json");
$result = Model::GetAllData();
print(json_encode($result));