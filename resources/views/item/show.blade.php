<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mx-auto py-12">
        <div class="container mx-auto max-w-3xl">
            <div class="w-full max-w-md mx-auto bg-white shadow-lg rounded-lg p-8">
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800">
                    <div class="mb-5">
                        <h1 class="text-center text-white text-2xl">Item Detail</h1>
                    </div>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        Item Name = {{ $item->name }}
                    </p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        Item Price = {{ $item->price }}
                    </p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        Item Stock = {{ $item->stock }}
                    </p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        Status = {{ $item->status }}
                    </p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        Category = {{ $item->category->name }}
                    </p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        Item Description = {{ $item->description }}
                    </p>
                    <a href="{{ route('item.index') }}"
                        class="focus:outline-none text-white bg-red-400 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-red-900">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
