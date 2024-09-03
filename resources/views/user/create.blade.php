<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Users</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mx-auto mt-10">
        <div class="w-full max-w-md mx-auto bg-white shadow-lg rounded-lg p-8">
            <form action="{{ route('user.store') }}" method="post">
                @csrf
                <div class="grid gap-4">
                    <div class="mb-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <input type="text" id="name" name="name"
                            class="
                            block
                            w-full
                            p-4
                            text-sm
                            text-gray-900
                            border
                            @error('name')
                                border-red-500
                            @enderror
                            rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500

                            "
                            value="{{ old('name') }}" placeholder="Enter your name" />
                        @error('name')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    @foreach ($posts as $post)
                        <div class="flex items-center mb-2">
                            <input id="post_id" type="checkbox" value="{{ $post->id }}" name="post_ids[]"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="posts" class="ms-2 text-sm font-medium text-gray-900">{{ $post->title }}
                        </div>
                    @endforeach
                    <button type="submit"
                        class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Create</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
