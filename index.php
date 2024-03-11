<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="./css/bootstrap.min.css" rel="stylesheet">

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
    <link href="./css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
    <img class="mb-4" src="./img/images-removebg-preview.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="text" name="id" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Identifient</label>
    </div>
    <div class="form-floating">
      <input type="password" name="pas" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign in</button>
    <?php
				$server="localhost";
				$pass="";
				$login="root";
				try{
					$connexion=new PDO("mysql:host=$server;dbname=projet",$login,$pass);
					$connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$request=$connexion -> prepare("SELECT * FROM `chef`");
					$request -> execute();
					$resultat=$request -> fetchall();
					if(isset($_POST['submit'])){
						$id=$_POST['id'];
						$pas=$_POST['pas'];
						if ($id==$resultat[0][0] && $pas==$resultat[0][1]) {
							header('Location:dash.php');
						}
						else{
							echo "<br><br><p style='color:red;'>Veuillez verifier vos entres.</p>";
						}
					}
				}
				catch(PDOException $e){
					echo "Connexion failed";
				}
			?>
    <p class="mt-5 mb-3 text-muted">&copy; 2023–2024</p>
  </form>
</main>


    
  </body>
</html>
