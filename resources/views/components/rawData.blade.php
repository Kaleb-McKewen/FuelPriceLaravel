<x-layout>

    <div class="flex flex-col mx-8">
        <div class="flex justify-center mb-4">
            <h1 class="text-3xl font-medium underline">Displaying Raw Data:</h1>
        </div>
        <div class="form-group">
            <select class="form-control" name="sort" id="sort"
                onchange="if (this.value) window.location.href=this.value">
                <option value="?sort=time&order=desc" @if (request('sort') == 'time' && request('order') == 'desc') selected @endif>Time [Newest
                    First]</option>
                <option value="?sort=time&order=asc" @if (request('sort') == 'time' && request('order') == 'asc') selected @endif>Time [Oldest
                    First]</option>
                <option value="?sort=average&order=desc" @if (request('sort') == 'average' && request('order') == 'desc') selected @endif>Average Price
                    [High-Low]</option>
                <option value="?sort=average&order=asc" @if (request('sort') == 'average' && request('order') == 'asc') selected @endif>Average Price
                    [Low-High]</option>
            </select>
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
                    <td class="border border-gray-300 text-center min-sm:text-lg"><a>More Info</a></td>
                    <!--add link to view more detail using $fuelprice->id-->
                </tr>
            @endforeach
        </table>

        {{ $fuelprices->appends(\Request::except('page'))->render() }}

    </div>

</x-layout>
