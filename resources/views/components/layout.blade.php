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
    <header class="bg-white m-8 border-b">
        <nav class="mx-auto flex items-center justify-between max-md:justify-center p-2 lg:px-8" aria-label="Global">
            <div class="flex max-md:hidden">
                <a href="{{ route('index') }}" class="-m-1.5 p-1.5">
                    <img class="h-6 max-md:hidden md:h-16 w-auto" src="{{ Vite::asset('resources/images/logo.svg') }}"
                        alt="Sunshine PC Repairs Logo">
                </a>
            </div>

            <div>
                <a href="{{ route('index') }}" class="-m-1.5 p-1.5">
                    <h1 class="text-4xl p-0">Fuel Price</h1>
                </a>
            </div>

            <div class="flex gap-x-2 sm:gap-x-6 md:gap-x-8 text-lg/6 font-semibold text-black">
                <a href="{{ route('index') }}">Summary</a> <!--Add styling for current page-->
                <a href="#">Raw Data</a>
                <a href="#">Source/Credits</a>

            </div>
        </nav>
    </header>

    {{ $slot }}

</body>

</html>
