<x-layout>



    <div class="max-lg:block flex flex-row items-center max-2xl:flex-col min-2xl:justify-center min-2xl:items-start">
        <div>
            <div class="flex justify-center">
                <h1 class="text-3xl font-medium underline">Displaying all Fuel Data:</h1>
            </div>
            <div class="chartBox w-full p-5 pb-0 flex justify-center align-middle">
                <canvas id="myChart" style="width:100%;max-width:1000px;height:700px;"></canvas>
            </div>
        </div>
        <div class="flex flex-col content-center items-center flex-wrap min-lg:w-md">
            <h2 class="text-3xl font-medium underline pb-4">Lowest 95 stations currently:</h2>
            <ul class="list-decimal">
                @foreach ($latestFuelprice as $fuelitem)
                    <li class="pb-1 text-lg">{{ $fuelitem }}</li>
                @endforeach

            </ul>
        </div>
    </div>

    <?php echo "<script>var times = '$times';</script>";
    echo "<script>var average_prices = '$average_prices';</script>"; ?>
    @vite(['resources/js/app.js', 'resources/js/graph.js'])

</x-layout>
