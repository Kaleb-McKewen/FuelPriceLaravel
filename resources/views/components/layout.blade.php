<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <title>Fuel Price</title>
</head>


<body class="font-outfit">
    <header class="bg-white mx-8 my-4 border-b">
        <nav class="mx-auto flex items-center justify-between px-2 pb-1 lg:px-8" aria-label="Global">
            <div>
                <a href="{{ route('index') }}" class="mx-1.5 px-1.5 flex flex-row items-center gap-x-10 py-3 min-sm:py-0">
                    <img class="h-8 min-sm:h-20 w-auto" src="{{ Vite::asset('resources/images/logo.svg') }}"
                        alt="Sunshine PC Repairs Logo">
                    <h1 class="max-md:hidden m-1.5 p-1.5 text-4xl">Fuel Price</h1>
                </a>
            </div>

            <div class="flex gap-x-2 sm:gap-x-6 md:gap-x-8 text-lg/6 font-semibold text-black">
                <a  @if(Route::currentRouteName() == 'index') class="text-red-500" @endif href="{{ route('index') }}">Summary</a>
                <a  @if(Route::currentRouteName() == 'raw') class="text-red-500" @endif href="{{ route('raw') }}">Raw Data</a>
                <a href="#">Source/Credits</a>

            </div>
        </nav>
    </header>

    {{ $slot }}

</body>

</html>
