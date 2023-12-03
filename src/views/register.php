<?php $title = 'Register' ?>
<?php require_once('views/partials/head.php') ?>
<?php
if (!isset($_SESSION)) {
    session_start();
} ?>

<main class="mt-5">
    <h1 class='text-center text-dark fw-bold'>Register</h1>
    <div class="d-flex justify-content-center">
        <form action="controllers/register_processing.php" method="post" class="d-flex flex-column mt-2 mx-3" style="width: 400px" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="name" required value="<?php echo isset($_SESSION['input_name']) ? $_SESSION['input_name'] : ''; ?>" />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email address</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="email" required value="<?php echo isset($_SESSION['input_email']) ? $_SESSION['input_email'] : ''; ?>" />
            </div>
            <div class=" mb-3">
                <label for="pwd" class="form-label fw-bold">Password</label>
                <input type="password" class="form-control" id="pwd" name="password" required />
            </div>
            <div class="mb-3">
                <label for="cfmpwd" class="form-label fw-bold">Confirm Password</label>
                <input type="password" class="form-control" id="cfmpwd" name="confirmpassword" required />
            </div>
            <a href="/login" class='text-dark mb-1'>Already a user? Login now</a>
            <input type="submit" class="btn btn-dark rounded-0" value="Register" />
        </form>
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
    <script src="js/validateRegister.js"></script>
</main>

<?php unset($_SESSION['input_email']) ?>
<?php require_once('views/partials/foot.php') ?>