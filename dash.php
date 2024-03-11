<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href="./css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="./fontawesome-free-6.1.1-web/css/all.min.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Dashboard</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home"></span>
              Enseignants
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./addArticles.php">
              <span data-feather="file"></span>
              Add article
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./articles.php">
              <span data-feather="file-text"></span>
              Articles
            </a>
          </li>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
          <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">Vertically centered hero sign-up form</h1>
            <p class="col-lg-10 fs-4">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
          </div>
          <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="dash.php">
              <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Noms</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" name="grade" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Grade</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" name="observe" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Observations</label>
              </div>
              <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Add</button>
            </form>
          </div>
        </div>
      </div>

      <h2>Liste des enseignents</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Noms</th>
              <th scope="col">Grade</th>
              <th scope="col">Observations</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php
              $server="localhost";
              $pass="";
              $login="root";
              try{
                $connexion=new PDO("mysql:host=$server;dbname=projet",$login,$pass);
                $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if(isset($_POST['edit_btn'])){
                    $id=$_POST['edit_id'];
                    $request=$connexion -> prepare("SELECT id FROM `enseignents`");
                    $request -> execute();
                    $resultat=$request -> fetchall();
                    for ($i=0; $i < count($resultat); $i++) { 
                      if($id==$resultat[$i][0]){
                        $request=$connexion -> prepare("DELETE FROM enseignents where id='$id'");
                        $request -> execute();
                        break;
                      }
                    }
                }
              }
              catch(PDOException $e){
                  echo "error";
              }
            ?>
            <?php
              $server="localhost";
              $pass="";
              $login="root";
            try{
              $connexion=new PDO("mysql:host=$server;dbname=projet",$login,$pass);
              $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              if(isset($_POST['submit'])){
                extract($_POST);
                $insertion ="INSERT INTO `enseignents`(`noms`, `grade`, `observations`) VALUES ('$name','$grade','$observe')";
                $connexion -> exec($insertion);
                
              }
              $request=$connexion -> prepare("SELECT * FROM `enseignents`");
              $request -> execute();
              $resultat=$request -> fetchall();
              for ($i=0; $i < count($resultat); $i++) { 
                $a1=$resultat[$i][0];
                $a2=$resultat[$i][1];
                $a3=$resultat[$i][2];
                $a4=$resultat[$i][3];
                echo"
                <tr>
                  <td>".($i+1)."</td>
                  <td>$a2</td>
                  <td class='No'>$a3</td>
                  <td>$a4</td>
                  <td>
                    <form action='' method='post'>
                      <input type='hidden' name='edit_id' value='$a1'>
                      <button  type='submit' name='edit_btn' style='color : red; border: none'><i class='fas fa-square-xmark'></i></button>
                    </form>
                  </td>
                </tr>";  
              }
            }
            catch(PDOException $e){
              echo "error";
            }
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


    <script src="./js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
