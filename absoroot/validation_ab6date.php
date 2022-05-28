<?php

function ab6date_is_valid($datetime)
{
    $clientdatetime = explode(" ", $datetime);
    if (count($clientdatetime) == 2) {
        $clientdate = explode("-", $clientdatetime[0]);
        if (count($clientdate) == 3) {
            if (
                preg_match('/^\d+$/', $clientdate[0]) &&
                preg_match('/^\d+$/', $clientdate[1]) &&
                preg_match('/^\d+$/', $clientdate[2])
            ) {
                $clientyear = (int) $clientdate[0];
                $clientmonth = (int) $clientdate[1];
                $clientday = (int) $clientdate[2];
                if ($clientyear < 0) {
                    return false;
                }
                if ($clientmonth < 0 || $clientmonth > 12) {
                    return false;
                }
                if ($clientday < 0) {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        $clienttime = explode(":", $clientdatetime[1]);
        if (count($clienttime) == 3) {
            if (
                preg_match('/^\d+$/', $clienttime[0]) &&
                preg_match('/^\d+$/', $clienttime[1]) &&
                preg_match('/^\d+$/', $clienttime[2])
            ) {
                $clienthour = (int) $clienttime[0];
                $clientmin = (int) $clienttime[1];
                $clientsec = (int) $clienttime[2];
                if ($clienthour < 0 || $clienthour > 24) {
                    return false;
                }
                if ($clientmin < 0 || $clientmin > 59) {
                    return false;
                }
                if ($clientsec < 0 || $clientsec > 59) {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
    return true;
}

?>