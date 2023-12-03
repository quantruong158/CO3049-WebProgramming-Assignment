<?php $title = 'Home' ?>
<?php require_once('views/partials/head.php') ?>
<?php require_once('views/partials/navbar.php') ?>
<?php
if (!isset($_SESSION)) {
    session_start();
} ?>

<main style="margin-top: 5rem;">
    <section class='container-fluid d-flex justify-content-center'>
        <div class='d-flex flex-column'>
            <h1 class="text-dark text-center text-lg-start fw-bold">Welcome <span class='text-nowrap'>Patient <?= $_SESSION['user_name'] ?></span></h1>
            <p class='fs-5 text-dark text-center text-lg-start'>Make appointment with doctor online with ease!</p>
            <a class="btn btn-lg btn-dark rounded-0 text-white align-self-center align-self-lg-end mt-3" href="/schedule">Make Appointment</a>
        </div>
    </section>
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
</main>

<?php require_once('views/partials/foot.php') ?>