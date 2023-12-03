<?php $title = 'Login' ?>
<?php require_once('views/partials/head.php') ?>
<?php
if (!isset($_SESSION)) {
    session_start();
} ?>

<main class='d-flex justify-content-center align-items-center vh-100'>
    <div class='mx-md-5 w-100 login'>
        <h1 class='text-center text-dark fw-bold'>Login</h1>
        <div class="d-flex justify-content-center">
            <form action="controllers/login_processing.php" method="post" class="d-flex flex-column mt-2 mx-3 w-100" onsubmit="return validateForm()">
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email address</label>
                    <input type="text" class="form-control rounded-0" id="email" name="email" aria-describedby="email" required />
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control rounded-0" id="pwd" name="password" required />
                </div>
                <a href="/register" class='text-dark mb-1'>New user? Register now</a>
                <input type="submit" class="btn btn-lg btn-dark rounded-0" value="Login" />
            </form>
        </div>
    </div>
    <div class='d-none d-sm-flex flex-column flex-grow-1 justify-content-center align-items-center container-fluid border-start border-3 border-dark h-100'>
        <div>
            <h2 class='fs-1'>Your <span class='fw-bold'>HEALTH</span> matters <br>
                Make appointment<span class='fw-bold'> NOW</span>.
            </h2>

        </div>
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <?php
        if (isset($_SESSION["message"])) {
        ?>
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success">
                    <strong class="me-auto text-white">Message</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?= $_SESSION["message"] ?>
                </div>
            </div>
        <?php
            unset($_SESSION["message"]);
        }
        ?>
    </div>
    <script src="js/validateLogin.js"></script>
</main>

<?php require_once('views/partials/foot.php') ?>