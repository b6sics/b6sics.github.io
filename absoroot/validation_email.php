<?php

$home_url = 'Location: https://b6.hu';
$target_url = 'Location: https://b6.hu/b8x';

$security_mail = 'security@levaipack.hu'; /* 3miLE6lOo1a8ll4 */

function email_is_valid($email_address)
{
    GLOBAL $security_mail;
    $email_address = filter_var($email_address, FILTER_SANITIZE_EMAIL);
    if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        return $email_address;
    } else {
        return $security_mail; 
    }
}

?>