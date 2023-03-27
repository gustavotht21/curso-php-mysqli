<?php
function userHome(int $profile_id)
{
    switch ($profile_id) {
        case 1:
            return 'adminHome.php';
            break;
        default:
            return 'commonUserHome.php';
    }
}
