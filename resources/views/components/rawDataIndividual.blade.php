<x-layout>

    <div class="flex flex-col mx-8">

        <div class="mb-4 flex justify-center text-center">
            <h1 class="text-3xl font-medium underline">Displaying Data on the {{ $fuelprice->time }}</h1>
            <div></div>
        </div>
        <div class="flex flex-col justify-center mb-4 items-center">
            <h2 class="text-2xl font-medium mb-12 text-center">The average price was $<u>{{ $fuelprice->average }}</u>
            </h2>
            <h2 class="text-2xl font-medium underline mb-4 text-center">The Lowest 95 stations on {{ $fuelprice->time }}
                were:</h2>
            <ul class="list-decimal">
                @foreach ($lowestFuelstations as $fuelstation)
                    <li class="pb-1 text-lg">{{ $fuelstation }}</li>
                @endforeach

            </ul>
        </div>
        <div class="min-md:absolute min-md:left-10 block m-4">
            <a class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
                href="{{ url()->previous('/raw') }}">Go Back</a>
        </div>
    </div>

</x-layout>
