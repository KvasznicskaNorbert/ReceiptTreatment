<?php
session_start(); 

    require_once("./engine/view.php");
    require_once("./engine/model.php");
    if(isset($_POST["ok"])){
        if(isset($_POST["username"]) &&
            isset($_POST["pass"])    
        ){
            $loginData = [
                "username" => $_POST["username"],
                "pass" => hash("sha256", $_POST["pass"])
            ];

            if(isset($_POST["remember"])){
                View::login($loginData, true);
            }
            else{
                View::login($loginData, false);
            }
             
        }
        else{
            $result = [
                "errorMessage" => "Sikertelen bejelentkezés"
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
    <title>Log In</title>
</head>
<body>
    
    <section class="vh-100">
        <div class="container py-5 h-100">
            
            <?php if(isset($result["errorMessage"])):  ?>
                <!-- Alert -->
                <div class="alert alert-danger" role="alert">
                    <?php print($result["errorMessage"]) ?>
                </div>
            <?php endif ?>
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="./img/draw2.svg"
                    class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <div class="w-25 m-auto">
                <h1 class="">Log In</h1>
            </div>
                    <form method="post">
                        <!-- Email input -->
                        <div class="form-floating mb-3">
                            <input type="text" id="username" name="username" class="form-control form-control-lg" onkeyup="loginCheck()" placeholder="Username" />
                            <label class="form-label" for="username">Username</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-floating mb-3">
                            <input type="password" id="pass" name="pass" class="form-control form-control-lg" onkeyup="loginCheck()" placeholder="Password" />
                            <label class="form-label" for="pass">Password</label>
                        </div>

                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" name="remember" id="remember" checked />
                            <label class="form-check-label" for="remember"> Remember me </label>
                            </div>  
                        </div>

                        <!-- Submit button -->
                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <button type="submit" name="ok"  id="logInBtn" class="btn btn-primary btn-lg btn-block">Sing In</button>
                        </div>

                        <!-- Registration button -->
                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <a href="reg.php"><button type="button"  class="btn btn-primary btn-lg btn-block">Sing up</button></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
       /* function loginCheck(){
            let username = document.getElementById("username").value;
            let pass = document.getElementById("pass").value;
            let btn = document.getElementById("logInBtn");

            if(username!= "" && pass != ""){
                btn.removeAttribute('disabled');
            }
            else{
                btn.setAttribute('disabled',"");
            }
        }*/
    </script>
</body>
</html>