<?php

/* curPageURL() 
 * getIP()
 * url_to_mainDomain($url)
 * isMainDomainType($mainDomain)
 * rightDomain($url)
 * url_code()
 */
function curPageURL() {
    $pageURL = 'http';
    if (@$_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function getIP() {
    $ip = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
}

function url_to_mainDomain($url) {
    $host = @parse_url($url, PHP_URL_HOST);
    if (!$host) {
        $host = $url;
    }
    if (strlen($host) > 50) {
        $host = substr($host, 0, 47) . '...';
    }
    $mainDomain = array();
    $mainDomain = explode('.', $host);
    return $mainDomain;
}

function isMainDomainType($mainDomain) {
    $storeTypeArray = Array("com", "co", "net", "org", "biz", "info", "tv", "ac",
        "school", "maori", "iwi", "edu", "pro", "name", "coop", "idv");
    $domain_type = array_intersect($mainDomain, $storeTypeArray);
    $isMainDomain = FALSE;
    if (count($domain_type) >= 1) {
        $isMainDomain = TRUE;
    } else {
        $isMainDomain = FALSE;
    }
    return $isMainDomain;
}

function getMainDomainIndex($mainDomain) {
    $storeTypeArray = Array("com", "co", "net", "org", "biz", "info", "tv", "ac",
        "school", "maori", "iwi", "edu", "pro", "name", "coop", "idv");
    $index = -1;
    for ($i = 0; $i < count($mainDomain); $i++) {
        if (in_array($mainDomain[$i], $storeTypeArray)) {
            $index = $i;
            break;
        }
    }
    return $index;
}

function rightDomain($url) {
    if (empty($url)) {
        $url = curPageURL();
    }
    $mainDomain = url_to_mainDomain($url);
    $right_domain = "";
    $index = getMainDomainIndex($mainDomain);
    if ($index != -1) {
        if ($index - 1 == 0) {
            $right_domain = "www." . implode(".", $mainDomain);
        } else {
            if ($mainDomain[0] != "www") {
                $right_domain ="www".implode(".", $mainDomain);
            }else
            {
                $right_domain =implode(".", $mainDomain);
            }
        }
    } else {
        $right_domain = implode(".", $mainDomain);
    }

    return $right_domain;
}

function url_code() {
    $result = $_SERVER['QUERY_STRING'];
    if (empty($result)) {
        $result = "null";
    }
    return $result;
}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
        $ipaddress = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    } else if (getenv('HTTP_X_FORWARDED')) {
        $ipaddress = getenv('HTTP_X_FORWARDED');
    } else if (getenv('HTTP_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } else if (getenv('HTTP_FORWARDED')) {
        $ipaddress = getenv('HTTP_FORWARDED');
    } else if (getenv('REMOTE_ADDR')) {
        $ipaddress = getenv('REMOTE_ADDR');
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}
?>


