<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Score 🎲</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500&amp;display=swap" rel="stylesheet">

        <link href="/css/normalize.css" rel="stylesheet">
        <link href="/css/main.css" rel="stylesheet">
    </head>
    <body class="antialiased bg-gray-100 dark:bg-gray-900">
        <div class="relative flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 md:items-top md:justify-start md:flex-row md:items-stretch">

            <div class="flex flex-col justify-center md:bg-white md:shadow-left md:mr-4 p-6 lg:px-8">
                <h2>Scored</h2>
                <h1 class="score"><?php echo $score ?? '?'; ?></h1>
                <form action="/score" method="POST">
                    @csrf
                    <button class="btn-random" type="submit">Get Score 🎲</button>
                </form>
            </div>
            <div class="chart md:h-auto" id="chart">
                <h3 class="chart-title">Frequency Distribution of Scores</h3>
            </div>
        </div>

        <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
        <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
        <script>
            const chart = new Chartisan({
                el: '#chart',
                url: "@chart('score_chart')",hooks: new ChartisanHooks()
                .legend()
                .tooltip(),
            });
        </script>
    </body>
</html>
