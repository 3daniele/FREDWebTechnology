<?php
include "../../../inc/init.php";
    session_start();
    if(isset($_SESSION["email"])){
        header("Location: " . ROOT_URL);
    }
?>
<?php
include ROOT_PATH . "public/template-parts/title.php";
?>
<title>Login</title>
<?php
include ROOT_PATH . "public/template-parts/header.php";
?>

<div class="container" id="main-area" style="margin-top: 70px;">
  <div class="row">
    <div class="col-4" style="margin-left: 9px;">
      <main class="form-signin">
        <form action="./login-action.php" method="post" >

          <h1 class="h3 mb-3 fw-normal">Login</h1>

          <div class="form-floating">
            <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
            <label for="floatingInput">Indirizzo Email</label>
          </div>
          <br>
          <div class="form-floating">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <br>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Ricordami
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        </form>
        <a href=".\register.php">Registrati</a>
      </main>
    </div>

    <div class="spazio" id="spazio_vuoto" style="margin-top: 110px;">

      <?php include ROOT_PATH . "public/template-parts/footer.php"; ?>