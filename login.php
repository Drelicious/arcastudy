<?php
session_start();
$email = "";
$password = "";
if (isset($_POST['login'])) {
$_email = $_POST['mail'];
$_password = $_POST['password'];
$url = 'https://data.mongodb-api.com/app/data-voebr/endpoint/data/v1/action/findOne';
$data = '
{
    "collection": "users",
    "database": "arcastudy",
    "dataSource": "Cluster0",
    "filter": {
        "mail": "' . $email . '", "password": "' . $password . '"
    }
}
';
$additional_headers = array(                                                                          
    'Content-Type: application/json',
    'Access-Control-Request-Headers: *',
    'api-key: ',
);
$ch = curl_init($url);                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, $additional_headers); 
$server_output = curl_exec ($ch);

$json = json_decode($server_output, true);
$_SESSION['email'] = $_email;
header('Location: dashboard.php');
exit;
if($json['document']['mail'] == $_email && $json['document']['password'] == $_password){

}}




?>



<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <div> 
            <div class="container-fluid ps-md-0">
                <div class="row g-0">
                  <col-lg-12>
                <p style="text-align: center;">Because of API limitation, and a few service agreements. You can't create account, instead try using the demo account!</p>
                </col-lg-12>
                  <div class="col-md-8 col-lg-12">
                    <div class="login d-flex align-items-center py-5">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-9 col-lg-8 mx-auto">
                            <h3 class="login-heading mb-4">Welcome back!</h3>
            
                            <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                              <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="mail" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                              </div>
                              <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                              </div>
          
                              <div class="d-grid">
                                <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" name="login" type="submit">Sign in</button>
                              </div>
              
                            </form>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            
        <script>       
            
            </script>
        <script src="" async defer></script>
    </body>
</html>