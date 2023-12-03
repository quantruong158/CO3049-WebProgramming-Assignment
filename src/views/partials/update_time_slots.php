<div class="row">
    <?php
    $timeSlots = range(1, 48);

    foreach ($timeSlots as $timeSlot) {
        $startTime = date('H:i', strtotime('00:00') + ($timeSlot - 1) * 30 * 60);
        $endTime = date('H:i', strtotime($startTime) + 30 * 60);

        // Check if the current time slot is in the available array
        $isAvailable = in_array($timeSlot, $availableTime);

    ?>
        <div class="col-6 col-sm-4 col-md-3 p-1">
            <?php if (!$isAvailable) {
                $isScheduled = in_array($timeSlot, $scheduledTime);
            ?>
                <?php if ($isScheduled) { ?>
                    <button type="button" disabled class="btn available-btn w-100 rounded-0"><?= $startTime . ' - ' . $endTime ?></button>
                <?php } else { ?>
                    <input type="checkbox" class="btn-check available" name="makeavailable[]" id="cb<?= $timeSlot ?>" value=<?= $timeSlot ?> autocomplete="off">
                    <label class="btn available-btn w-100 rounded-0 border-3 fw-semibold" for="cb<?= $timeSlot ?>"><?= $startTime . ' - ' . $endTime ?></label>
                <?php } ?>
            <?php } else { ?>
                <input type="checkbox" class="btn-check busy" name="makebusy[]" id="cb<?= $timeSlot ?>" value=<?= $timeSlot ?> autocomplete="off">
                <label class="btn border-3 busy-btn fw-semibold w-100 rounded-0" for="cb<?= $timeSlot ?>"><?= $startTime . ' - ' . $endTime ?></label>
            <?php } ?>
        </div>
    <?php } ?>
</div>