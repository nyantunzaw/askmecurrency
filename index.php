<?php 
//emoticons
function decodeEmoticons($src) {
    $replaced = preg_replace("/\\\\u([0-9A-F]{1,4})/i", "&#x$1;", $src);
    $result = mb_convert_encoding($replaced, "UTF-16", "HTML-ENTITIES");
    $result = mb_convert_encoding($result, 'utf-8', 'utf-16');
    return $result;
}
$emo = "\xe2\x82\xa9";
//$emo = decodeEmoticons($src);
//emoticons end

$url = "http://forex.cbm.gov.mm/api/latest";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$contents = curl_exec($ch);
if (curl_errno($ch)) {
  echo curl_error($ch);
  echo "\n<br />";
  $contents = '';
} else {
  curl_close($ch);
}

if (!is_string($contents) || !strlen($contents)) {
echo "Failed to get contents.";
$contents = '';
}

//echo $contents;

$json = file_get_contents($url);
$obj = json_decode($contents,true);
$ratesUSD = $obj['rates']['USD'];
$ratesSGD = $obj['rates']['SGD'];
$ratesTHB = $obj['rates']['THB'];
$ratesEUR = $obj['rates']['EUR'];
$ratesAUD = $obj['rates']['AUD'];
$ratesKRW = $obj['rates']['KRW'];

//currency symbols
$sybUSD = "$";
$sybSGD = "S$";
$sybTHB = "\340\270\277";
//$sybEUR = "\xe2\x82\xa0";
$sybEUR = "\342\202\254";
$sybAUD = "A$";
$sybKRW = "\xe2\x82\xa9";


//$msg = '{"messages": [{"text": "USD - '.$ratesUSD.'"},{"text":"THB - '.$ratesTHB.'"}]}';
$msg = '{"messages": [{"text": "Today\'s Currency Exchange Rates \n=======\nUS Dollar('.$sybUSD.'1)\t\t'.$ratesUSD.' Kyat\nSG Dollar('.$sybSGD.'1)\t\t'.$ratesSGD.' Kyat\nThai Baht('.$sybTHB.'1)\t\t'.$ratesTHB.' Kyat\nAussie Dollar('.$sybAUD.'1)\t'.$ratesAUD.' Kyat\nEuro('.$sybEUR.'1)\t\t\t'.$ratesEUR.' Kyat\nKorea Won('.$sybKRW.'1)\t\t'.$ratesKRW.' Kyat"}]}';
echo $msg;

$fp = fopen('data.json', 'w');
fwrite($fp, $msg);
fclose($fp);


//echo $obj['timestamp'];

//echo "SGD : ";
//echo $obj['rates']['SGD'];
//echo "<br/>";
//echo "EUR : ";
//echo $obj['rates']['EUR'];
//echo "<br/>";
//echo "AUD : ";
//echo $obj['rates']['AUD'];

?>