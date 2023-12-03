<?php $title = 'Schedule' ?>
<?php require_once('views/partials/head.php') ?>
<?php require_once('views/partials/navbar.php') ?>
<?php
if (!isset($_SESSION)) {
    session_start();
} ?>
<main style="margin-top: 6rem;">
    <form action="controllers/update_schedule.php" method="POST" class='d-flex flex-column gap-2'>
        <div class='container-fluid d-flex align-items-md-start flex-column flex-md-row justify-content-center w-100 container-fluid gap-2'>
            <label>
                <p class='m-0 fw-semibold'>Select a date</p>
                <input name="date" type="date" class="border-3 fs-5 fw-semibold" id="datepicker" min="<?= date('Y-m-d', strtotime('+1 day')); ?>" max="<?= date('Y-m-d', strtotime('+7 day')); ?>">
            </label>
            <div class='d-flex flex-column border border-3 border-dark flex-grow-1 sched w-100 p-2' style="min-height: 500px;">
                <div class='d-flex flex-column flex-lg-row justify-content-between'>
                    <h2 class='fw-semibold text-nowrap' id="selectedDate">Please select a date</h2>
                    <div>
                        <div class='btn btn-dark rounded-0 border-3 fw-semibold'>Available</div>
                        <div class='btn btn-outline-dark rounded-0 border-3 fw-semibold'>Busy</div>
                        <button disabled class='btn btn-outline-dark rounded-0 '>Scheduled</button>
                    </div>
                </div>
                <div class="container-fluid" id="timeSlotContainer">

                </div>
            </div>
        </div>
        <button id="makeAppointmentBtn" disabled type="button" class="btn btn-lg btn-dark rounded-0 mx-2 mb-2" data-bs-toggle="modal" data-bs-target="#confirmModal">Update Schedule</button>
        <!-- Modal -->
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="modalLabel">Confirm</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Are you sure to update the Schedule?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-outline-dark rounded-0" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-lg btn-dark rounded-0" value="Update Schedule" />
                    </div>
                </div>
            </div>
        </div>
    </form>

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

<script src='js/doctorSchedule.js'></script>

<?php require_once('views/partials/foot.php') ?>