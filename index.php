<?php
    session_start();
    require_once "db.php";
    $msg = "";
    if(isset($_POST['login'])){
        
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        if(empty($username) && empty($password)){
            $msg = "Please fill all fields";
        }else{
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            if(!$user){
                $msg ="user does not Exist. Contact Administrator";
            }else{
                if ($password !== $user['password']) {
                    $msg = "Invalid Password";
                }else{
                    $_SESSION['user'] = $username;
                    header('Location:invoice.php');
                }
            }

        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login To Invoice</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />
    <style>
      .common-img-bg {
  background-size: cover;
  background: url(images/bg.jpg);
  width: 100vw;
  height: 100vh; }
    
    </style>
</head>


    <div class="container common-img-bg">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                
                <div class="card border-primary ">
                    <div class="card-header bg-primary">
                        <h4 class="text-center text-light">Login Here</h4>
                    </div>
                    <div class="card-body">
                        <?php if($msg !=""): ?>
                                <div class="alert alert-danger"><?php echo $msg; ?> </div>

                        <?php endif; ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="login" class="btn btn-primary btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="js/invoice.js"></script>
</body>

</html>
