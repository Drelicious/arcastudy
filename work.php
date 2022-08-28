<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: login.php");
}
$email = $_SESSION['email'];
$url = 'https://data.mongodb-api.com/app/data-voebr/endpoint/data/v1/action/find';
$data = '
{
    "collection": "work",
    "database": "arcastudy",
    "dataSource": "Cluster0",
    "filter": {
        "mail": "' . $email . '", "status": "pending"
    }
}
';
$additional_headers = array(                                                                          
    'Content-Type: application/json',
    'Access-Control-Request-Headers: *',
    'api-key: 2JA5awVZkaKndcyNn4fZClYz1E5WuazH94IC4TnTYbFIjCIJMtNCnqhMlf8aXAB6',
);
$ch = curl_init($url);                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, $additional_headers); 
$server_output = curl_exec ($ch);
$json = json_decode($server_output, true);
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
        <title>arcaStudy | Inbox</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/dashboard.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
              <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <div class="loader"><i data-feather="book"></i></div>
        <div class="preload">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-auto bg-light sticky-top">
                    <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top">
                        <a href="/" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                            <i class="bi-bootstrap fs-1"></i>
                        </a>
                        <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center justify-content-between w-100 px-3 align-items-center">
                            <li class="nav-item">
                                <a href="/dashboard.php" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
                                    <i data-feather="home"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/work.php" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
                                    <i data-feather="book"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                                    <i data-feather="bar-chart"></i>
                                </a>
                            </li>
                            <li>
                                <a href="/vent.php" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Orders">
                                    <i data-feather="message-square"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Products">
                                    <i data-feather="inbox"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="user"></i>
                            </a>
                            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                                <li><a class="dropdown-item" href="#">Log Out</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm p-3 min-vh-100">
                   <h1 class="headingthing">Hai, Drelicious Arcanius</h1>
                   <p>Planning to do your work? You can do it!</p>
                   <?php
foreach($json['documents'] as $d) {
  foreach($d as $k=>$v) {
    $due = "";
      if ($k == "_id") {
        $id = $v;
      }
      if ($k == "work") {
       $work = $v;
      }
      if ($k == "Due") {
          $due = $v;
      }
      if ($k == "description") {
          $description = $v;
      }
      if ($k == "randomizer") {
          $randomizer = $v;
      }
    }
    echo "<div class='modal fade' id='$id' tabindex='-1' role='dialog' aria-labelledby='$id' aria-hidden='true'>";
    echo "<div class='modal-dialog modal-dialog-centered' role='document'>";
    echo "<div class='modal-content'>";
    echo "<div class='modal-header'>";
    echo "<h5 class='modal-title' id='$id'>$work</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "<div class='modal-body'>
    <button data-toggle='modal' href='#$id$id' data-target='#$id$id'>Start now</button> 
    <form action='' method='post'>
    <button type='submit' name='finish' value='$randomizer' >Finished (Without Timer)</button> 
    </form>
    <p>$description</p>
    <div style='margin: 10px;'>
    </div>         
  ";
    echo "<p>$id</p>";
    echo "</div>";
    echo "<div class='modal-footer'>";
    echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "<div class='modal fade' id='$id$id' tabindex='-1' role='dialog' aria-labelledby='$id$id' aria-hidden='true'>";
    echo "<div class='modal-dialog modal-fullscreen modal-dialog-centered' role='document'>";
    echo "<div class='modal-content'>";
    echo "<div class='modal-header'>";
    echo "<h5 class='modal-title' id='$id$id'>$work</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "<div class='modal-body'>
    <div style='margin: 10px;'>
    </div>
  ";
    echo "<p>$id</p>";
    echo "</div>";
    echo "<div class='modal-footer'>";
    echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  }

?>
                   <div class="container-fluid">
                    <div class="row">
                          <div class="col-md-6">
                            <div class="card">
                              <div class="card-header">
                                Work List
                              </div>
                              <div class="card-body">
                                <div class="row">
                                <div class="col-12">
                                  <div style="overflow-y: scroll; height:400px;">
                                    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 100%;">
                                    <div class="list-group list-group-flush border-bottom scrollarea">
                                        <?php
                                        if(!$json['documents']) {
                                          echo '
                                          <a href="#" class="list-group-item list-group-item-action  py-3 lh-tight" aria-current="true">
                                          <div class="d-flex w-100 align-items-center justify-content-between">
                                            <strong class="mb-1">You have no work to do</strong>
                                            <small></small>
                                          </div>
                                          <div class="col-10 mb-1 small"></div>
                                        </a>
                                          ';
                                        }
                                        
foreach($json['documents'] as $d) {
    foreach($d as $k=>$v) {
      $due = "";
        if ($k == "_id") {
          $id = $v;
        }
        if ($k == "work") {
         $work = $v;
        }
        if ($k == "Due") {
            $due = $v;
        }
        if ($k == "description") {
            $description = $v;
        }
      }
    echo "
    <a data-toggle='modal' href='#$id' data-target='#$id' class='list-group-item list-group-item-action  py-3 lh-tight' aria-current='true'>
    <div class='d-flex w-100 align-items-center justify-content-left'>
      <strong class='mb-1'>$work</strong>
      <small>$due</small>
    </div>
    <div class='col-10 mb-1 small'><p>test</p></div>
  </a>
    ";
    }
        ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                </div>
                              </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                              <div class="card">
                                <div class="card-header">
                                  <b>Add work to list!</b>
                                </div>
                                <div class="card-body">
                                <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                                    <div class="form-group" style="margin-bottom: 10px;">
                                      <label for="work">Work</label>
                                      <input type="text" required class="form-control" name="workes" id="work" placeholder="Work">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                      <label for="work">Last Submission Date</label>
                                      <input type="date" required class="form-control" name="due" id="work" placeholder="Date">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                      <label for="work">Estimated time to finish it (in minutes)</label>
                                      <input type="number" required class="form-control" name="eta" id="work" placeholder="Time">
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                      <label for="work">Description</label>
                                      <textarea class="form-control" required id="work" name="description" rows="3"></textarea>
                                    </div>
                                    <button type="submit" name="workbutton" class="btn btn-primary">Submit</button>
                                  </form>
                                  <?php
           if (isset($_POST['workbutton'])) {
            $work = $_POST['workes'];
            $due = $_POST['due'];
            $eta = $_POST['eta'];
            $description = $_POST['description'];

            $insertURL = 'https://data.mongodb-api.com/app/data-voebr/endpoint/data/v1/action/insertOne';
$data = '
{
    "collection": "work",
    "database": "arcastudy",
    "dataSource": "Cluster0",
    "document": {
        "work": "' . $work . '",
        "Due": "' . $due . '",
        "estimatedTime": "' . $eta . '",
        "description": "' . $description . '",
        "status": "pending",
        "mail": "' . $_SESSION['email'] . '",
        "dateAdded": "' . date("Y-m-d") . '",
        "randomizer": "' . rand(1, 100) . ' + ' . rand(1, 100) . '"
    }
}
';
$additional_headers = array(                                                                          
    'Content-Type: application/json',
    'Access-Control-Request-Headers: *',
    'api-key: 2JA5awVZkaKndcyNn4fZClYz1E5WuazH94IC4TnTYbFIjCIJMtNCnqhMlf8aXAB6',
);
$ch3 = curl_init($insertURL);                                                                      
curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch3, CURLOPT_POSTFIELDS, $data);                                                                  
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch3, CURLOPT_HTTPHEADER, $additional_headers); 
$insert = curl_exec ($ch3);
echo "<meta http-equiv='refresh' content='0'>" ;
$insertResult = json_decode($server_output, true);
           }


// update work status to done
if (isset($_POST['finish'])) {
  $updateURL = 'https://data.mongodb-api.com/app/data-voebr/endpoint/data/v1/action/updateOne';
$data = '
{
    "collection": "work",
    "database": "arcastudy",
    "dataSource": "Cluster0",
    "filter": {
      "randomizer" : "'. $_POST['finish'] .'"
    },
    "update": {
        "$set": {
            "status": "done"
        }
    }
}
';

$additional_headers = array(                                                                          
    'Content-Type: application/json',
    'Access-Control-Request-Headers: *',
    'api-key: 2JA5awVZkaKndcyNn4fZClYz1E5WuazH94IC4TnTYbFIjCIJMtNCnqhMlf8aXAB6',
);

$ch4 = curl_init($updateURL);
curl_setopt($ch4, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch4, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch4, CURLOPT_HTTPHEADER, $additional_headers);
$update = curl_exec ($ch4);
$updateResult = json_decode($server_output, true);
echo "<meta http-equiv='refresh' content='0'>" ;
}


?>
                                </div>
                                </div>
                              </div>
                            </div>
                    </div>
                   </div>
                </div>
                <hr>
                <p style="text-align: center;">Powered by Linode | Submission for Garuda Hackathon</p>
            </div>
        </div>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.min.js"></script>
</script>

        <script>
            feather.replace()
          </script>
          <script>
    setTimeout(function(){
        document.getElementsByClassName("loader")[0].style.display = "none";
    }, 1000);




            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [{
                label: '# of work',
                  data: [1, 0, 5, 3, 2, 0, 5],
                  lineTension: 0,
                  backgroundColor: 'transparent',
                  borderColor: '#007bff',
                  borderWidth: 4,
                  pointBackgroundColor: '#007bff'
                }, {
                label: '# of work done',
                  data: [1, 0, 5, 3, 2, 0, 8],
                  lineTension: 0,
                  backgroundColor: 'transparent',
                  borderColor: '#000000',
                  borderWidth: 4,
                  pointBackgroundColor: '#007bff'
                }]
              }
              ,
              options: {
                scales: {
                  yAxes: [{
                    ticks: {
                      beginAtZero: false
                    }
                  }]
                },
                legend: {
                  display: true,
                }
              }
            });
          </script>
        <script src="" async defer></script>
        </div>
    </body>
</html>