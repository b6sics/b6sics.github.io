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
    $calendar->attachObserver('showCell', $highlightToday);

    echo $calendar->show();
    ?>
    <main>
        <section>
            <p>
                <a href="linkek.html">Filmek, könyvek, letöltési oldalak, webáruházak linkjei</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/php-file-upload-tutorial-part-1">PHP File Upload 1.</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/php-file-upload-tutorial-part-2">PHP File Upload 2.</a>.
            </p>
            <h3>
                Understanding Design Patterns in PHP
            </h3>
            <p>
                <a href="https://startutorial.com/view/understanding-design-patterns-abstract-factory">Abstract Factory</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/understanding-design-patterns-adapter">Adapter</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/understanding-design-patterns-command">Command</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/understanding-design-patterns-composite">Composite</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/understanding-design-patterns-decorator">Decorator</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/understanding-design-patterns-facade">Facade</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/understanding-design-patterns-factory-method">Factory Method</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/understanding-design-patterns-observer">Observer</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/understanding-design-patterns-simple-factory">Simple Factory</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/understanding-design-patterns-singleton">Singleton</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/understanding-design-patterns-state">State</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/understanding-design-patterns-strategy">Strategy</a>.
            </p>
            <p>
                <a href="https://startutorial.com/view/understanding-design-patterns-template-method">Template Method</a>.
            </p>
        </section>
    </main>

    <footer class="bottom center static">
        <h4>
            HU-1111 Budapest Bercsényi utca 6.<br /> &#9993; b6@b6.hu | &#9743; 30-4654562
        </h4>
    </footer>

</body>

</html>