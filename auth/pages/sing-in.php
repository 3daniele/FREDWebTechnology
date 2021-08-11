<?php include "../../public/template-parts/header.php";
?>
<div class="container" id="main-area" style="margin-top: 70px;">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
            <main class="form-signin">
                <form>
                    <h1 class="h3 mb-3 fw-normal">Sign in</h1>

                    <div class="form-floating">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <br>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                    
                </form>
            </main>
        </div>
        <?php
        include '../../template-parts/sidebar.php';
        ?>



        <?php
        include "../../public/template-parts/footer.php";
        ?>