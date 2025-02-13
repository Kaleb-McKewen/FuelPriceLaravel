<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>All Fuel Data</title>
</head>

<body>
    <div class="flex justify-center">
        <h1 class="text-3xl font-bold underline">Displaying all Fuel Data:</h1>
    </div>

        <div class="chartCard">
            <div class="chartBox">
                <canvas id="myChart" style="width:100%;max-width:700px;height: 500px;">></canvas>
            </div>
        </div>

        {{ $latestFuelprice }}

        <?php echo "<script>var times = '$times';</script>";
        echo "<script>var average_prices = '$average_prices';</script>"; ?>

        @vite(['resources/js/chart.umd.min.js', 'resources/js/graph.js'])
    
</body>

</html>
