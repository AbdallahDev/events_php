<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" lang="AR">
        <title></title>
        <link href="../css/css.css" rel="stylesheet" type="text/css"/>
        <link href="../css/css_weather.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>
            function get_time_live() {
                $.get('get_time_live.php', function (data, status) {
                    if (data == 0) {
                        $('#date').hide();
                        $('#weather').hide();
                        $('#urgent_div').hide();
                        $('#youtube').hide();
                        $('#session').hide();
                        $('#bottom_container').css("background-image", 'none');
                    } else if (data == 1) {
                        $('#date').show();
                        $('#weather').show();
                        $('#urgent_div').show();
                        $('#session').show();
                        $('#bottom_container').css("background-image", "url('../imgs/bottom.png')");
                    }

                });
            }
            function show_events() {
                $.get('events_get_live.php', function (data, status) {
                    $('#events').html(data);
                });
            }
            function show_session() {
                $.get('session_get_live.php', function (data, status) {
                    $('#session').html(data);
                });
            }
            function show_urgents() {
                $.get('urgents_get_live.php', function (data, status) {
                    $('#urgent').html(data);
                });
            }
            function session_video_status() {
                $.get('session_video_status.php', function (data, status) {
                    if (data == 1) {
                        $('#youtube').show();
                    } else {
                        $('#youtube').hide();
                    }
                });
            }
            function show_background() {
                $.get('backgrounds_get_live.php', function (data, status) {
                    $('#event_show').css("background-image", "url(" + data + ")");
                });
            }
            $(document).ready(function () {
                show_events();
                show_session();
                session_video_status();
                show_urgents();
                show_background();
            });
            function call_functions() {
                get_time_live();
                show_events();
                show_session();
                session_video_status();
                show_urgents();
                show_background();
            }
            setInterval(call_functions, 1000);
        </script>
    </head>
    <body id="event_show">
        <div id="events"  >
        </div>
    </body>
</html>
