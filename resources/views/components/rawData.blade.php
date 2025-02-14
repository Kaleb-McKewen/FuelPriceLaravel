<x-layout>


<div class="flex flex-col mx-8">
    <div class="flex justify-center mb-4">
    <h1 class="text-3xl font-medium underline">Displaying Raw Data:</h1>
    </div>
    <table class="table-auto border border-gray-400 border-separate mb-8">
        <tr>
            <th class="border border-gray-300 text-xl">Time</th>
            <th class="border border-gray-300 text-xl">Average</th>
            <th class="border border-gray-300 text-xl"></th>
        </tr>
        @foreach ($fuelprices as $fuelprice)
            <tr>
                <td class="border border-gray-300 text-center min-sm:text-lg">{{ $fuelprice->time }}</td>
                <td class="border border-gray-300 text-center min-sm:text-lg">{{ $fuelprice->average }}</td>
                <td class="border border-gray-300 text-center min-sm:text-lg"><a>More Info</a></td> <!--add link to view more detail using $fuelprice->id-->
            </tr>
        @endforeach
    </table>

    {{ $fuelprices->links() }}
</div>

</x-layout>
