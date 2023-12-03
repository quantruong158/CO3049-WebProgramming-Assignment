<?php $title = 'Schedule' ?>
<?php require_once('views/partials/head.php') ?>
<?php require_once('views/partials/navbar.php') ?>
<?php
if (!isset($_SESSION)) {
    session_start();
} ?>
<main style="margin-top: 6rem;">
    <form action="controllers/change_processing.php" method="POST" class='d-flex flex-column gap-2'>
        <div class='container-fluid d-flex align-items-md-start flex-column flex-md-row justify-content-center w-100 container-fluid gap-2'>
            <div>
                <label class='w-100'>
                    <p class='m-0 fw-semibold'>Select a doctor</p>
                    <select name="doctor" class="form-select rounded-0 border-dark border-3 fw-semibold" aria-label="select-input" id="selectDoctor">
                        <?php
                        foreach ($doctors as $doctor) { ?>
                            <option class="fw-semibold" value=<?= $doctor["id"] ?>><?= $doctor["full_name"] ?></option>
                        <?php } ?>
                    </select>
                </label>
                <br>
                <label class='w-100'>
                    <p class='m-0 fw-semibold'>Select a date</p>
                    <input name="date" type="date" class="border-3 fs-5 fw-semibold w-100" id="datepicker" min="<?= date('Y-m-d', strtotime('+1 day')); ?>" max="<?= date('Y-m-d', strtotime('+7 day')); ?>">
                </label>
            </div>
            <div class='d-flex flex-column border border-3 border-dark flex-grow-1 sched w-100 p-2' style="min-height: 500px;">
                <div class='d-flex flex-column flex-lg-row justify-content-between'>
                    <h2 class='fw-semibold text-nowrap' id="selectedDate">Please select a date</h2>
                    <div>
                        <div class='btn btn-dark rounded-0 border-3 fw-semibold'>Selected</div>
                        <div class='btn btn-outline-dark rounded-0 border-3 fw-semibold'>Available</div>
                        <button disabled class='btn btn-outline-dark rounded-0 '>Unavailable</button>
                    </div>
                </div>
                <div class="container-fluid" id="timeSlotContainer">

                </div>
            </div>
        </div>
        <button id="makeAppointmentBtn" disabled type="button" class="btn btn-lg btn-dark rounded-0 mx-2 mb-2" data-bs-toggle="modal" data-bs-target="#confirmModal">Change Appointment</button>
        <!-- Modal -->
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="modalLabel">Confirm to change this appointment?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>New appointment details:</h6>
                        <h5 class="card-title text-nowrap fw-bold" id="cfmDate">Date:</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary fw-semibold text-nowrap" id="cfmTime">Time:</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-outline-dark rounded-0" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-lg btn-dark rounded-0" value="Change Appointment" />
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
<script src='js/patientSchedule.js'></script>
<?php require_once('views/partials/foot.php') ?>