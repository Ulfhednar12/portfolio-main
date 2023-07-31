<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href=https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Login Page</title>
</head>

<body>

<div class="wrapper">
    <form class="form-signin" method="POST" action="valide_admin.php">       
      <h2 class="form-signin-heading">Connexion</h2>
      <input type="text" class="form-control" name="username" placeholder="Pseudo" required="" autofocus="" />
      <br>
      <input type="password" class="form-control" name="password" placeholder="Mot de passe" required=""/>      
  
      <button class="btn btn-lg btn-primary btn-block" type="submit">se connecter</button>   
    </form>
  </div>
</body>

</html>