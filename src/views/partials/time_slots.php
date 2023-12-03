<div class="row">
    <?php
    $timeSlots = range(1, 48);

    foreach ($timeSlots as $timeSlot) {
        $startTime = date('H:i', strtotime('00:00') + ($timeSlot - 1) * 30 * 60);
        $endTime = date('H:i', strtotime($startTime) + 30 * 60);

        // Check if the current time slot is in the available array
        $isAvailable = in_array($timeSlot, $availableTime);

        echo '<div class="col-6 col-sm-4 col-md-3 p-1">';
    ?>
        <?php if ($isAvailable) { ?>
            <input type="radio" class="btn-check" name="timeSlot" id="radio<?= $timeSlot ?>" value=<?= $timeSlot ?> autocomplete="off">
            <label class="btn btn-outline-dark w-100 rounded-0 border-3 fw-bold" for="radio<?= $timeSlot ?>"><?= $startTime . ' - ' . $endTime ?></label>
        <?php } else { ?>
            <button type="button" class="btn btn-outline-dark w-100 rounded-0 disabled"><?= $startTime . ' - ' . $endTime ?></button>
        <?php } ?>

    <?php
        echo '</div>';
    }
    ?>
</div>