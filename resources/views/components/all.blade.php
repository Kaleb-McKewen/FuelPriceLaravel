<x-layout>
    
    <div class="flex justify-center">
        <h1 class="text-3xl font-bold underline">Displaying all Fuel Data:</h1>
    </div>


    <div class="chartBox w-full h-full p-5 flex justify-center align-middle">
        <canvas id="myChart" style="width:100%;max-width:1000px;height: 700px;"></canvas>
    </div>

    <div class="flex flex-col content-center items-center flex-wrap">
        <h2 class="underline text-2xl">Lowest 95 unleaded fuel stations currently:</h2>
    <ul>
        @foreach ($latestFuelprice as $fuelitem)
            <li>{{ $fuelitem }}</li>
        @endforeach
    
    </ul>
    </div>

    <?php echo "<script>var times = '$times';</script>";
    echo "<script>var average_prices = '$average_prices';</script>"; ?>
@vite(['resources/js/app.js', 'resources/js/graph.js'])

</x-layout>
