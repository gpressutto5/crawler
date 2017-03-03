<?php
function is_valid($url)
{
    $headers = get_headers("http://".$url."/cart");
    $status = substr($headers[0], 9, 3);
    if ($status === "200") {
        return true;
    }
    return false;
}
