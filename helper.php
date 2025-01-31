<?php
function getContent($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept-Language: pt-BR']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
	curl_setopt($ch, CURLOPT_URL, $url);
	$response = curl_exec($ch);
	curl_close($ch);

	return $response;
}

function checkCart($url) {
	$headers = get_headers("http://".$url."/cart");
	$status = substr($headers[0], 9, 3);
	if ($status === "200") {
		return true;
	}
	return false;
}

function contains($str, array $arr)
{
    foreach($arr as &$a) {
        $a = "($a)";
    }
    $regwords = implode("|", $arr);
    if (preg_match("/\b$regwords\b/", $str)) return true;
    return false;
}

function check($url, array $arr)
{
	if (checkCart($url)) {
		if (stripos($url, ".com.br") !== false) {
			return true;
		}
		return contains(getContent($url), $arr);
	}
	return false;
}
