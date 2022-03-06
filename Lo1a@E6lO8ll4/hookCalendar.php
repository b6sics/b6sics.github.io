<html>
<head>    
<link href="h8kCalendar.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
    include 'h8kCalendar.php';
    $calendar = new Calendar();

    include 'highlight_today.php';
    $highlightToday = new HighlightToday();
    $calendar->attachObserver('showCell',$highlightToday);

    echo $calendar->show();
?>
</body>
</html>