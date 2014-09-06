<?php
$post_data = array();
$post_data['hlpretag'] = "<span class='s-fc7'>";
$post_data['hlposttag'] = "</span>";
$post_data['s'] = $_GET["key"];
$post_data['type'] = "1";
$post_data['offset'] = "1";
$post_data['total'] = "false";
$post_data['limit'] = "30";
$o = "";
foreach ($post_data as $k => $v) {
    $o .= "$k=" . urlencode($v) . "&";
}
$post_data = substr($o, 0, -1);
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://music.163.com/api/search/get/web?csrf_token=");

curl_setopt($ch, CURLOPT_REFERER, "http://music.163.com"); 
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_NOBODY, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_TIMEOUT, 10); 

curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
$result = curl_exec($ch);

curl_close($ch);


$arr = json_decode($result,true)["result"]["songs"];
for($i=0;$i<30;$i++){
    $ids .= $arr[$i]["id"].',';
}
/*
foreach($arr as $a){
    $ids .= $a["id"].',';
}*/
$ids = substr_replace($ids, "", -1);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://music.163.com/api/song/detail?ids=[".$ids."]");
curl_setopt($ch, CURLOPT_REFERER, "http://music.163.com");
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_NOBODY, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_TIMEOUT, 10); 

$result = curl_exec($ch);

curl_close($ch);

$arr = json_decode($result) -> songs;
$newArr = array();

for($i=0;$i<30;$i++){
    $newArr[$i] = new StdClass;
    $newArr[$i] -> name = $arr[$i] ->name;
    $newArr[$i] -> author = $arr[$i] -> album ->artists[0] ->name;
    //$newArr[$i] -> url = $arr[$i] ->mp3Url;
    $newArr[$i] -> pic = $arr[$i] -> album ->picUrl;
    //$newArr[$i] -> duration = $arr[$i] ->duration;
    //$newArr[$i] -> time =$arr[$i] -> alum->artists[0]->publishTime;
    $newArr[$i] -> id = $arr[$i] -> id;
}

echo json_encode($newArr);
