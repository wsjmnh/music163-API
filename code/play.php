<?php
$id = $_GET['id'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://music.163.com/api/song/detail?ids=[".$id."]"); //$url 目标地址
    curl_setopt($ch, CURLOPT_REFERER, "http://music.163.com"); //$referer_url 要伪造的地址
    curl_setopt($ch, CURLOPT_HEADER,0); //只获取http头信息,如果不使用这个设置,则相当在服务器上下载该文件了.这样会占用服务器的资源.
    curl_setopt($ch, CURLOPT_NOBODY, 0); //不返回html的body信息
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //返回数据流，不直接输出
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); //超时时长，单位秒
//为了支持cookie
    $result = curl_exec($ch);
//释放curl句柄
    curl_close($ch);
    $song = json_decode($result)->songs;
    $name =  $song[0]->name;
    $author =  $song[0]->artists[0]->name;
    $duration =  $song[0]->duration;
    $picUrl =  $song[0]->album->picUrl;
    $mp3Url =  $song[0]->mp3Url;


?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta charset="UTF-8">
    <title>music.yyf.me</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="themes/music.min.css"/>
    <link rel="stylesheet" href="themes/jquery.mobile.icons.min.css"/>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile.structure-1.4.3.min.css"/>
    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>

    <link rel="stylesheet" href="add-on/css/not.the.skin.css">
    <link rel="stylesheet" href="add-on/circle.skin/circle.player.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script type="text/javascript" src="add-on/js/jquery.transform2d.js"></script>
    <script type="text/javascript" src="add-on/js/jquery.grab.js"></script>
    <script type="text/javascript" src="add-on/js/jquery.jplayer.js"></script>
    <script type="text/javascript" src="add-on/js/mod.csstransforms.min.js"></script>
    <script type="text/javascript" src="add-on/js/circle.player.js"></script>
    <!--<script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>-->
<style>
    .ui-header, .ui-footer {
        border-width: 0;
    }
</style>
</head>

<body>


<div data-role="page" data-theme="a">

    <div data-role="header" data-position="fixed">

    </div>
    <div data-role="content">

<div id="bg" style="width: 100%;height: 100%">
        <!-- This is the 2nd instance's jPlayer div -->
        <div id="jquery_jplayer_2" class="cp-jplayer"></div>

        <div class="prototype-wrapper"> <!-- A wrapper to emulate use in a webpage and center align -->



            <!-- This is the 2nd instance HTML -->

            <div id="cp_container_2" class="cp-container" style="background: url('<?php echo $picUrl; ?>'); background-size: 100% 100%;">
                <div class="cp-buffer-holder">
                    <div class="cp-buffer-1"></div>
                    <div class="cp-buffer-2"></div>
                </div>
                <div class="cp-progress-holder">
                    <div class="cp-progress-1"></div>
                    <div class="cp-progress-2"></div>
                </div>
                <div class="cp-circle-control"></div>
                <ul class="cp-controls">
                    <li><a class="cp-play" tabindex="1">play</a></li>
                    <li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
                </ul>
            </div>

        </div>
</div>
        <h1 style="text-align: center"><?php echo $name  ?></h1>
        <h3 style="text-align: center"><?php echo $author  ?></h3>
        <br>
        <br>
        <a href="music.yyf.me" class="ui-btn ui-icon-back">Back</a>

    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            //$('#cp-container_2').css({backgroundImage: url(<?php echo $img ?>)"});

            //$(".cp_container_2").css("background","yellow");


            var myOtherOne = new CirclePlayer("#jquery_jplayer_2",
                {
                    m4a:"<?php echo $mp3Url ?>"
                }, {
                    cssSelectorAncestor: "#cp_container_2"
                });
        });
    </script>
</body>
</html>
