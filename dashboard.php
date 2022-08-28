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
    'api-key: ',
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
        <title>arcaStudy | Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/dashboard.css">
              <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <div class="loader"><i data-feather="book"></i></div>
        <div class="preload">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-auto bg-light sticky-top">
                    <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top">
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
                                <a href="inbox.html" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Products">
                                    <i data-feather="inbox"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="user"></i>
                            </a>
                            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                                <li><a class="dropdown-item" href="/logout">Log Out</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm p-3 min-vh-100">
                   <h1 class="headingthing">Hai, Drelicious Arcanius</h1>
                   <p>what a great day to start your day~!</p>
                   <div class="card">
                    <div class="card-header">
                      Your Daily Feeds
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6 ms-auto">
                                    <div class="card">
                                        <div class="card-header">
                                            Greetings.
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text blockquote">Welcome, welcome!</p>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="card-header">
                                   Analytics
                                </div>
                                <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
                            </div>
                            <div class="col-sm-6">
                                <div class="card mobilewidget pconly" >
                                    <div class="card-header">
                                        <b>Work To-do</b>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col">
                                                  <div class="column">
                                                    <div class="col" id="homework">
                            <div class="vertical carousel slide" data-ride="carousel" data-bs-ride="carousel" id="works">
                              <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <p>Hello :D</p>
                                </div>
                                <?php
                                                    if (!$json['documents']) {
                                                        echo "<div class'carousel-item active'>";
                                                        echo "<div class='col'>";
                                                        echo "<h4>No work to do :D</h4>";
                                                        echo "<p>you did it! happy for ya!</p>";
                                                    }
                                
                    foreach($json['documents'] as $d) {
                        foreach($d as $k=>$v) {
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
                            echo "<div class='carousel-item'>";
                            echo "<div class='col'>";
                            echo "<h4>$work</h4>";
                            echo "<p>$due</p>";
                            echo "</div>";
                            echo "</div>";
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
                                    <a href="/work.php" class="btn btn-primary">Jump to Work</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card mobilewidget" >
                                <div class="card-header">
                                    Also read this about <b>Mental Health</b>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.min.js"></script>
        <script>
          
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
                  pointBackgroundColor: '#000000'
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
    </body>
</html>