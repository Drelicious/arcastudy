<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: login.php");
}
$email = $_SESSION['email'];
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>arcaStudy | Chat with AI</title>
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
                      Personalize your experience
                    </div>
                    <div class="card-body" style="height: 300px; overflow-x:scroll;">
                    <p>We use AI, to give you personalized experience. By, making each login messages as uniquely as possible. We use sentiment to pick decision</p>
                    <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Type your message here</label>
                            <textarea class="form-control" required  name="message" rows="3"></textarea>
                        </div>
                        <button type="submit" name="chat" class="btn btn-primary">Submit</button>
                    
                    <?php
                    if(isset($_POST['chat'])){
                        $message = $_POST['message'];
                        $url = 'https://api.cohere.ai/classify';
                        $data = '
                        {
                            "inputs": "'.$message.'",
                            "examples": "[{"text": "i hate myself", "label": "negative"}, {"text": "im idiot", "label": "negative"}, {"text": "im smart", "label": "positive"}, {"text": "i\'m doing great", "label": "positive"}, {"text": "i can\'t stay anymore", "label": "negative"}, {"text": "this been too much", "label": "negative"}, {"text": "i feel like i wanna quit", "label": "negative"}, {"text": "i can\'t stay for much longer", "label": "negative"}, {"text": "i can do this", "label": "positive"}, {"text": "i will always be around", "label": "positive"}, {"text": "you can do it", "label": "positive"}, {"text": "i can do it", "label": "positive"}]"
                        }
                        ';
                        $additional_headers = array(                                                                          
                            'Content-Type: application/json',
                            'Authorization: BEARER {}'
                        );
                        $ch = curl_init($url);                                                                      
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $additional_headers); 
                        $server_output = curl_exec ($ch);
                        $json = json_decode($server_output, true);
                        if ($json['message'] == "invalid api token") {
                            echo "AI services is unavaliable, because of API Token";
                        }
                    }

?>
                    </form>
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
          async function getNumberOfFollowers() {
            const response = await axios.get('https://api.github.com/users/drelicious');
            return response.data.followers;
          }
          console.log(getNumberOfFollowers());
          </script>
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