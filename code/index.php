<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta charset="UTF-8">
    <title>music.yyf.me</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../themes/music.min.css"/>
    <link rel="stylesheet" href="../themes/jquery.mobile.icons.min.css"/>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.3/jquery.mobile.structure-1.4.3.min.css"/>
    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.3/jquery.mobile-1.4.3.min.js"></script>
    <script src="js/jquery.blockUI.js"></script>


</head>

<body>


<div data-role="page" data-theme="a">

    <div data-role="header" data-position="fixed">

        <h1>music.YYF.me</h1>
    </div>
    <div data-role="content" data-theme="d">
        <input type="text" id="name">
        <button class="ui-btn ui-corner-all" id="send">Search</button>
    </div>
    <div id="content">
        <ul data-role="listview" data-inset="true">
        </ul>



    </div>
    <script type="text/javascript">
        var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F3093f1f86f6a4d624ad723ea7ac259ba' type='text/javascript'%3E%3C/script%3E"));
    </script>

</body>
</html>
<script type="text/javascript">
    $(function () {
        $("#send").click(function () {
            var cont = $("#name").val();
            $.ajax({
                url: 'search.php',
                type: 'get',
                dataType: 'json',
                data: "key=" + cont,
                success: function (songs) {
                    $('#content ul').empty();
                    for (var i = 0; i < 10; i++) {
                        $('#content ul').append(
                            $('<li>').append(
                                $('<a>').append(
                                    $('<img>').attr('src',songs[i].pic),
                                    $("<h2>").append(songs[i].name),
                                    $("<p>").append(songs[i].author)
                                )
                                .attr("href","play.php?id="+songs[i].id)
                                .attr('rel',"external")
                            )
                        );

                    }
                    $('#content ul').listview('refresh');

                }
            });
        });
    });
</script>

