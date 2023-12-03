<?php $title = 'History' ?>
<?php require_once('views/partials/head.php') ?>
<?php require_once('views/partials/navbar.php') ?>
<?php
if (!isset($_SESSION)) {
    session_start();
} ?>
<main class="container" style="margin-top: 5rem;">
    <section class='container-fluid d-flex justify-content-center px-sm-4'>
        <div class='d-flex flex-column align-items-center align-items-md-start container-fluid'>
            <h2 class="text-dark text-center text-lg-start">Doctor <span class='text-nowrap fw-bold'><?= $_SESSION["user_name"] ?></span></h2>
            <h4 class="text-dark-emphasis text-center text-lg-start fs-6"><?= $_SESSION["user_email"] ?></h2>
                <div class='row container-fluid'>
                    <?php
                    if (empty($slots)) {
                        echo "<h2 class='text-center'>No appointments found.</h2>";
                    } else {
                        foreach ($slots as $slot) : ?>
                            <?php
                            $startTime = date('H:i', strtotime('00:00') + ($slot["slot_value"] - 1) * 30 * 60);
                            $endTime = date('H:i', strtotime($startTime) + 30 * 60);

                            $date = $slot["slot_date"];
                            $time = $startTime;
                            $dateTime = $date . ' ' . $time;

                            $inputDateTime = new DateTime($dateTime);
                            $currentDateTime = new DateTime();

                            $vietnamTimezone = new DateTimeZone('Asia/Ho_Chi_Minh');
                            $currentDateTime->setTimezone($vietnamTimezone);

                            $isOutdated = $inputDateTime->format('Y-m-d H:i') < $currentDateTime->format('Y-m-d H:i');
                            ?>
                            <div class="card col-12 col-sm-6 col-lg-4 rounded-0 p-1 border-0">
                                <div class="card-body p-2 border border-dark border-2 position-relative">
                                    <h5 class="card-title text-nowrap fw-bold"><?= $slot["slot_date"] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary fw-semibold text-nowrap"><?= $startTime . ' - ' . $endTime ?></h6>
                                    <h6 class="card-subtitle mb-2 text-body-secondary fw-semibold text-nowrap">Patient <?= $slot["full_name"] ?></h6>
                                    <?php if (!$isOutdated) { ?>
                                        <form class="delete-form" action="controllers/cancel_appointment.php?slotId=<?= $slot["id"] ?>" method="POST">
                                            <button type="button" class="btn btn-outline-danger border-dark text-dark border-top-0 border-end-0 border-2 rounded-0 p-1" data-bs-toggle="modal" data-bs-target="#cancel<?= $slot["id"] ?>">Cancel</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="cancel<?= $slot["id"] ?>" tabindex="-1" aria-labelledby="label<?= $slot["id"] ?>" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                    <div class="modal-content rounded-0">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5 fw-bold" id="label<?= $slot["id"] ?>">Cancel this appointment?</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6>Appointment details:</h6>
                                                            <?php
                                                            $startTime = date('H:i', strtotime('00:00') + ($slot["slot_value"] - 1) * 30 * 60);
                                                            $endTime = date('H:i', strtotime($startTime) + 30 * 60);
                                                            ?>
                                                            <h5 class="card-title text-nowrap fw-bold">Date: <?= $slot["slot_date"] ?></h5>
                                                            <h6 class="card-subtitle mb-2 text-body-secondary fw-semibold text-nowrap">Time: <?= $startTime . ' - ' . $endTime ?></h6>
                                                            <h6 class="card-subtitle mb-2 text-body-secondary fw-semibold text-nowrap">Doctor <?= $slot["full_name"] ?></h6>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-dark rounded-0" data-bs-dismiss="modal">Close</button>
                                                            <input type="submit" class="btn btn-dark rounded-0" value="Cancel Appointment" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <?php } else { ?>
                                        <button disabled class='float-end btn btn-dark text-white rounded-0'>Outdated</button>
                                    <?php } ?>
                                </div>

                            </div>
                    <?php endforeach;
                    } ?>
                </div>
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