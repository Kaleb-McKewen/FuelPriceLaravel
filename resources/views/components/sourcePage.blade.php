<x-layout>

    <div class="flex flex-col mx-8 items-center flex-wrap text-center">
        <div class="mb-4">
            <h1 class="text-3xl font-medium underline">Data Source Credits</h1>
            <!--Add Source Attributions from API-->
        </div>
        <div class="w-auto max-w-2xl">
            <p class="text-center text-xl">{{ env("API_REFERENCE") }}</p>
        </div>
    </div>
</x-layout>
