<x-layout>

    <div class="max-lg:block flex flex-row items-center max-2xl:flex-col min-2xl:justify-center min-2xl:items-start">
        <div>
            <div class="flex justify-center">
                <h1 class="text-3xl font-medium underline">Displaying all Fuel Data:</h1>
            </div>
            <div class="chartBox !w-full p-5 pb-0 flex justify-center align-middle h-[400px] min-sm:h-[700px] max-w-[1000px]">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="flex flex-col content-center items-center flex-wrap min-lg:w-md">
            <h2 class="text-3xl font-medium mb-6 text-center">$<u>{{ $price }}</u> is the average price of 95 fuel as of {{ $time }}.</h2>
            <h2 class="text-3xl font-medium underline mb-4 text-center">Lowest 95 stations currently:</h2>
            <ul class="list-decimal">
                @foreach ($lowestFuelstations as $fuelstation)
                    <li class="pb-1 text-lg">{{ $fuelstation }}</li>
                @endforeach

            </ul>
        </div>
    </div>

    <?php echo "<script>var times = '$times';</script>";
    echo "<script>var average_prices = '$average_prices';</script>"; ?>
    @vite(['resources/js/app.js', 'resources/js/graph.js'])

</x-layout>
