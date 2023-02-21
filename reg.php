<?php 
session_start(); 
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Registration</title>
</head>
<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="w-25 m-auto">
                <h1 class="">Registration</h1>
            </div>
            

            <?php if(isset($result["errorMessage"])):  ?>
                <!-- Alert -->
                <div class="alert alert-danger" role="alert">
                    <?php print($result["errorMessage"]) ?>
                </div>
            <?php endif ?>

            <?php if(isset($result["success"])):  ?>
                <!-- Alert -->
                <div class="alert alert-success" role="alert">
                    <?php print($result["success"]) ?>
                </div>
            <?php endif ?>

            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="./img/draw2.svg"
                    class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form method="post" >
                        <!-- Username -->
                        <div class="form-floating mb-3">
                            <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Username" required />
                            <label  for="username">Username</label>
                        </div>
                        <!-- Email input -->
                        <div class="form-floating mb-4">
                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email adress" required />
                            <label class="form-label" for="email">Email address</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-floating mb-4">
                            <input type="password" id="pass" name="pass" class="form-control form-control-lg" placeholder="Password" required />
                            <label class="form-label" for="pass">Password</label>
                        </div>
                        <!--Password verify-->
                        <div class="form-floating mb-4">
                            <input type="password" id="passverify" name="passverify" class="form-control form-control-lg" onkeyup="passCheck()" placeholder="Password verify" required />
                            <label class="form-label" for="passverify">Password verify</label>
                        </div>

                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                            <label class="form-check-label" for="form1Example3"> Remember me </label>
                            </div>  
                        </div>

                        <!-- Submit button -->
                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <button type="submit" name="ok" id="ok" disabled class="btn btn-primary btn-lg btn-block" >Sign up</button>
                        </div>

                        <!-- Log In -->
                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <a href="login.php"><button type="button" class="btn btn-primary btn-lg btn-block" >Sing In</button></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        function passCheck(){
            let pw1 = document.getElementById("pass").value;
            let pw2 = document.getElementById("passverify").value;
            let email = document.getElementById("email").value;
            let username = document.getElementById("username").value;
            let btn = document.getElementById("ok");
            
            if(pw1 == pw2 & email != "" && username != ""){
                btn.removeAttribute('disabled');
            }
            else{
                
                btn.setAttribute('disabled',"");
            }            
        }
    </script>
</body>
</html>