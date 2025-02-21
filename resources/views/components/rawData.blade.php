<x-layout>

    <div class="flex flex-col mx-8">
        <div class="flex justify-center mb-4">
            <h1 class="text-3xl font-medium underline">Displaying Raw Data:</h1>
        </div>
        <div class="form-group">
            <select class="form-control border border-gray-400" name="sort" id="sort"
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
        <table class="table- w-full border border-gray-400 border-separate mb-8">
            <tr>
                <th class="border border-gray-300 text-xl w-1/3">Time</th>
                <th class="border border-gray-300 text-xl w-1/3">Average</th>
                <th class="border border-gray-300 text-xl w-1/3"></th>
            </tr>
            @foreach ($fuelprices as $fuelprice)
                <tr>
                    <td class="border border-gray-300 text-center min-sm:text-lg py-0.5">{{ $fuelprice->time }}</td>
                    <td class="border border-gray-300 text-center min-sm:text-lg py-0.5">{{ $fuelprice->average }}</td>
                    <td class="border border-gray-300 text-center"><a href="/raw/{{ $fuelprice->id }}" class="align-[0.5px] text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-sm text-sm px-1 py-0.5 self-center min-sm:text-lg">More Info</a></td>
                </tr>
            @endforeach
        </table>

        {{ $fuelprices->appends(\Request::except('page'))->render() }}

    </div>

</x-layout>
