<?php

function sanitise($data) {
    trim($data);
    strip_tags($data);
    stripslashes($data);
    htmlspecialchars($data);

    return $data;
}
?>