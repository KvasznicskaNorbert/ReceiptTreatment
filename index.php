<?php
require_once("./engine/view.php");
 require_once("./engine/model.php");
session_start();
    if(!isset($_SESSION["userid"])){
        header("location: login.php");
    }

    if(isset($_POST["logout"])){
        View::logout();
    }
    $id= $_SESSION["userid"];

    if(isset($_POST["newpassok"])){
        
        if(isset(
            $_POST["thepass"],
            $_POST["newpass"],
            $_POST["newpass2"]
        )){
            if(hash("sha256", $_POST["newpass"] === hash("sha256", $_POST["newpass2"])))
            {
                $data = [
                    "update" => "changePass",
                    "userid" => $_SESSION["userid"],
                    "oldpass" => hash("sha256", $_POST["thepass"]),
                    "newpass1" => hash("sha256", $_POST["newpass"]),
                   ];
                    View::changePass($data);
                    $result = [
                        "success" => "Jelszó frissítve!"
                    ];
            }                                  
        }
    }

    if(isset($_POST["newusernameok"])){
        if(isset($_POST["newusername"])){
            $data = [
                "update" => "changeusername",
                "userid" => $_SESSION["userid"],
                "newUsername" => $_POST["newusername"],
            ];
            View::changeusername($data);
            $result = [
                "success" => "Felhasználónév frissítve!"
            ];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    
    
    
    <title>Számla összegző</title>
</head>
<body>
    
    <div class="container">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand">Hello: <?php print($_SESSION["username"]) ?></a>
            <div> 
                <ul class="nav nav-pills">
                    <li class="nav-item">
                    <a href="logout.php"><button class="btn btn-outline-success my-2 my-sm-0" name="logout" type="button">Log Out</button></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Settings</a>
                        <ul class="dropdown-menu">
                        <li>
                            <button type="button" class="btn btn-light my-2 my-sm-0" data-bs-toggle="modal" data-bs-target="#changepass">
                            Change Password
                            </button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-light my-2 my-sm-0" data-bs-toggle="modal" data-bs-target="#changeusername">
                            Change Username
                            </button>
                        </li>
                        
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Alert -->
        <?php
       
        if(isset($result["errorMessage"])): ?>
            <div class="alert alert-danger" role="alert">
                <?php print($result["errorMessage"]) ?>
            </div>
        <?php endif ?>
        <!-- Alert -->
        <?php if(isset($result["success"])): ?>
            <div class="alert alert-success" role="alert">
                <?php print($result["success"]) ?>
            </div>
        <?php endif ?>
            
        <div class="m-4 ">
            <div class="m-auto" style="width: 42px;">
                <button type="button" id="togglebtn" class="btn btn-light">
                <i class="bi bi-plus-lg"></i>
                </button>
            </div>
            <div class="w-25 m-auto" id="addData">
                <form action="insert.php" method="post" >
                    <div class="form-group">
                        <label for="nyugtasorszam"> Nyugta sorszáma</label>
                        <input type="text" id="nyugtasorszam" name="nyugtasorszam" class="form-control" value="BNENB">
                    </div>
    
                   <div class="form-group">
                        <label for="szamlasorszam"> Számla sorszáma</label>
                        <input type="text" id="szamlasorszam" name="szamlasorszam"  class="form-control">
                   </div>
    
                   <div class="form-group">
                        <label for="vevoneve"> Vevő neve</label>
                        <input type="text" id="vevoneve" name="vevoneve"  class="form-control">
                   </div>
    
                    <div class="form-group">
                        <label for="bevetel"> Bevétel összege</label>
                        <input type="text" id="bevetel" name="bevetel"  class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label for="fizetesdatum"> Kifizetés dátuma</label>
                        <input type="date" id="fizetesdatum" name="fizetesdatum"  class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" id="ok" name="ok">Rögzít</button>
                </form>
            </div>
            <div>
                <?php
                    if(isset($_POST["kifizdatum"])){
                        $datas = Model::GetAllData($id, "kifizdatum");
                    }
                    elseif(isset($_POST["bevosszeg"])){
                        $datas = Model::GetAllData($id, "bevosszeg");
                    }
                    elseif(isset($_POST["szamla"])){
                        $datas = Model::GetAllData($id, "szamla");
                    }
                    else{
                        $datas = Model::GetAllData($id, "szamla");
                    }

                    $osszbevetel = 0;
                    foreach($datas as $data){
                        $osszbevetel += $data["bevosszeg"];
                    }
                ?>
                <div class="w-25 mb-3">
                   
                    <div class="form-group">
                            <label for="searchSerialNumber">Keresés sorszámra: </label>
                            <input type="text" id="searchSerialNumber" name="searchSerialNumber"  class="form-control" onkeyup="Search('searchSerialNumber')">
                    </div>
                    <div class="form-group">
                            <label for="searchDate">Keresés dátumra: </label>
                            <input type="text" id="searchDate" name="searchDate"  class="form-control" onkeyup="Search('searchDate')">
                    </div>

                    
                </div>
                <h3>Összes bevétel: <?php echo $osszbevetel; ?> </h3>
                <h3 id="szurtbev">Bevétel a szürt keresési feltételekkel:</h3>
            </div>
            <div class=" table-responsive" style="height: 800px">
                <table class="mx-auto mt-3 table table-striped table-hover" id="myTable">
                    <thead>
                        <th colspan="2">
                            Biszonylat (nyugta, számla sorszáma)
                            <form  method="post">
                                <button class="btn btn-light btn-sm" name="szamla">
                                    <i class="bi bi-arrow-down-square"></i>
                                </button>
                            </form>
                        </th>
                        <th>Vevő neve számla esetén </th>
                        <th>
                            Bevétel összege 
                            <form  method="post">
                                <button class="btn btn-light btn-sm" name="bevosszeg">
                                    <i class="bi bi-arrow-down-square"></i>
                                </button>
                            </form>
                        </th>
                        <th>
                            Kifizetés dátuma 
                            <form method="post">
                                <button class="btn btn-light btn-sm" name="kifizdatum">
                                    <i class="bi bi-arrow-down-square"></i>
                                </button>
                            </form>
                        </th>
                        <th></th>
                    </thead>
                    <tbody id="tablerow">
                        <?php foreach($datas as $data):?>
                            <tr onclick="moreInfo()">
                        <td class="nyugta"><?php print("$data[nyugta]"); ?></td>
                        <td class="szamla" ><?php print("$data[szamla]"); ?></td>
                        <td class="vevoneve"><?php print("$data[vevoneve]"); ?></td>
                        <td class="bevosszeg"><?php print("$data[bevosszeg]"); ?></td>
                        <td class="kifizdatum"><?php print("$data[kifizdatum]"); ?></td>
                        <td>
                        <form method="post" action="delete.php">
                            <input type="hidden" name="id" value ="<?php echo $data["id"] ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </form>   
                        </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        
 <?php
    include("./modal/usernameChange.php");
    include("./modal/passChange.php");

  ?>







</body>
   

<script>
    $(document).ready(function(){
        $("#togglebtn").click(function(){
            $("#addData").slideToggle();
        });
    });


    function onReady(promise){
  
        let nyugta = document.getElementsByClassName("nyugta");
        let szamla = document.getElementsByClassName("szamla");
        let vevoneve = document.getElementsByClassName("vevoneve");
        let bevosszeg = document.getElementsByClassName("bevosszeg");
        let kifizdatum = document.getElementsByClassName("kifizdatum");

        promise.then(response => response.forEach(function(item, index){
           
            nyugta[index].innerHTML = item.nyugta;
            szamla[index].innerHTML = item.szamla;
            vevoneve[index].innerHTML = item.vevoneve;
            bevosszeg[index].innerHTML = item.bevosszeg;
            kifizdatum[index].innerHTML = item.kifizdatum;
            
        }));
    }

    function Search(prop) {
        let tdID = 0;

        if(prop =="searchSerialNumber"){
             tdId = 1;
        }
        else if(prop =="searchDate"){
             tdId = 4;
        }
        
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById(prop);
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        let osszeg = 0;
        
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
           
                td = tr[i].getElementsByTagName("td")[tdId];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    osszeg += Number(tr[i].getElementsByTagName("td")[3].innerHTML);
                } else {
                    tr[i].style.display = "none";
                }
                }
               
        }
       document.getElementById("szurtbev").innerHTML=`Bevétel a szürt keresési feltételekkel: ${osszeg}`;  
    }

    //GetCall(onReady);

</script>
</body>
</html>