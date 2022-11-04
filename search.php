<?php

$fn = $_REQUEST["first"];
$ln = $_REQUEST["last"];
$st = $_REQUEST["state"];
$api = $_REQUEST["api"];
if (bad($fn) || bad($ln) || bad($st)) {
    $fn = "John";
    $ln = "Citizen";
    $st = "VIC";
}

$username = "dGlub3IyNDExNkBoYXJjaXR5LmNvbQ==";
$password = "VmFnZW5lMzIx";

$login_url = "aHR0cHM6Ly9jZGEuY291cnRkYXRhLmNvbS5hdS9sb2dpbg==";
$search_url = "aHR0cHM6Ly9jZGEuY291cnRkYXRhLmNvbS5hdS9zZWFyY2gjLw==";
$search_api = "aHR0cHM6Ly9jZGEuY291cnRkYXRhLmNvbS5hdS9zZWFyY2gvYXBpL3Jlc3VsdHM=";


$ch = curl_init();

startConnection();
$htm = getPage(base64_decode($login_url));


$token = extractSimple($htm, "name=\"_token\" value=\"", "\"");
//echo $token;
$page = login($username, $password, $token);
$page = getPage(base64_decode($search_url));
$data = json_decode(collectResults($fn, $ln, $st), true);

$results = $data["total"];
$pages = $data["totalPages"];
$output = $data["output"];
$pageNow = 1;
if ($pages > 1) {
    while ($pageNow <= $pages) {
        $pageNow++;
        $data = json_decode(collectResults($fn, $ln, $st, $pageNow), true);

        $resultsloop = $data["total"];
        $pagesloop = $data["totalPages"];
        $outputloop = $data["output"];
        $output = array_merge($output, $outputloop);
    }
}

$readPages = $pageNow - 1;
$resultsloaded = count($output);
$missedResults = $results - $resultsloaded;

if($api == "true")
{
header("Content-Type: application/json");
header("HTTP/1.1 200 OK");
echo json_encode($output, JSON_PRETTY_PRINT);
}


endConnection();


function collectResults($fname, $lname, $state = "", $page = 1)
{
    global $ch;
    global $token;
    global $search_api;
    $state = strtoupper($state);
    curl_setopt(
        $ch,
        CURLOPT_URL,
        base64_decode($search_api)
    );
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        "_token=" .
            $token .
            "&given_name=" .
            urlEncode($fname) .
            "&surname=" .
            urlEncode($lname) .
            "&state=" .
            $state .
            "&page=" .
            $page .
            "&type=name&company="
    );

    $page = curl_exec($ch);
    $error = curl_error($ch);

    $results = $page;

    $errorMsg = $error;
    if (strlen($errorMsg) < 1) {
        $errorMsg = $results;
    }

    return $results;
}

function login($username, $password, $token)
{
    global $ch;
    global $login_url;
    curl_setopt($ch, CURLOPT_URL,base64_decode($login_url));
    curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        "_token=" .
            $token .
            "&email=" .
            urlEncode(base64_decode($username)) .
            "&password=" .
            urlEncode(base64_decode($password))
    );
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $page = curl_exec($ch);
    $error = curl_error($ch);

    $results = $page;

    $errorMsg = $error;
    if (strlen($errorMsg) < 1) {
        $errorMsg = $results;
    }

    return $results;
}

function extractSimple($html, $keyToken, $keyEndChar)
{
    $keyStart = strpos($html, $keyToken) + strlen($keyToken);
    $keyEnd = strpos($html, $keyEndChar, $keyStart);
    $keyLength = $keyEnd - $keyStart;
    $keyExtract = substr($html, $keyStart, $keyLength);
    return $keyExtract;
}

function getPage($url)
{
    global $ch;
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_POST, 0);
    $data = curl_exec($ch);
    return $data;
}

function endConnection()
{
    global $ch;
    curl_close($ch);
}

function startConnection()
{
    global $ch;
    global $login_url;
    $agent =
        "Mozilla/5.0 (Linux; Android 10; Samsung 87 2011) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Mobile Safari/537.36";

    $cookieFile = "cookies.txt";
   if (!file_exists($cookieFile)) {
           file_put_contents($cookieFile,"");
       }

    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);
    curl_setopt($ch, CURLOPT_REFERER, base64_decode($login_url));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT_MS, 500000);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
}

function bad($data)
{
    return strlen($data) < 1;
}
function contains($search, $input)
{
    return strpos($input, $search) !== false;
}

function randomProxy($updateList = false)
{
    $proxyList = [];

    if ($updateList) {
        $proxyList = randomProxyList();
    }
    return trim($proxyList[array_rand($proxyList, 1)]);
}

function randomProxyList()
{
    $proxies = file(
        "https://api.proxyscrape.com/v2/?request=getproxies&protocol=http&timeout=6000&country=all&ssl=yes&anonymity=anonymous&simplified=true"
    );
    return $proxies;
}

function hasParam($param)
{
    return array_key_exists($param, $_REQUEST);
}

?>
