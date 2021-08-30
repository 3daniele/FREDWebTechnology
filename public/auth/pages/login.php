<?php
include "../../../inc/init.php";

if (isset($_SESSION["email"])) {
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

<?php
$emailErr = "";
$passwordErr = "";
$email = "";
$password = "";
$display = "style=\"display: none\"";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } elseif (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    test_input();
  }
}

function test_input()
{
  global $display;
  $email = $_POST["email"];
  $password = $_POST["password"];

  $passHash = hash("sha1", $password);

  $userMgr = new UserManager();
  $login = $userMgr->login($email, $passHash);

  if ($login == null) {
    $display = "style=\"display: true\"";
  } else {
    $_SESSION["email"] = $email;
    foreach ($login as $log) {
      $_SESSION["img"] = $log["img"];
      $_SESSION["admin"] = $log["user_type"];
      $_SESSION["name"] = $log["name"];
      $_SESSION["userid"] = $log["id"];
    }
    header("Location: " . ROOT_URL . "shop");
  }
}
?>

<div class="row">
    <div class="col-4"></div>
    <div class="col-4">
        <div class="alert alert-dismissible alert-danger text-center" <?php echo $display; ?>>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Email e/o password errati!</strong>
        </div>
    </div>
</div>

<div class="container" id="main-area" style="margin-top: 25px;">
  <div class="row">
    <div class="col-4" style="margin-left: 9px;">
      <main class="form-signin">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

          <h1 class="h3 mb-3 fw-normal">Login</h1>

          <div class="form-floating">
            <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
            <label for="floatingInput">Indirizzo Email</label>
            <span class="error"><?php echo $emailErr; ?></span>
          </div>
          <br>
          <div class="form-floating">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
            <span class="error"><?php echo $passwordErr; ?></span>
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

    <div class="spazio" id="spazio_vuoto" style="margin-top: 80px;">

      <?php include ROOT_PATH . "public/template-parts/footer.php"; ?>