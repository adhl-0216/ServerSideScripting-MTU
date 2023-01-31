<?php

function euroToSterling($euro) {
    return $euro*0.88;
}

echo 'Pound Sterling (£): '.euroToSterling($_GET['euro']);
