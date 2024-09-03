<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Items</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mx-auto mt-10">
        <div class="w-full max-w-md mx-auto bg-white shadow-lg rounded-lg p-8">
            <form action="{{ route('item.update', $item->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="grid gap-4">
                    <div class="mb-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}"
                            class="
                            @error('name')
                                border-red-600
                            @enderror
                            block w-full p-4 ps-10 text-sm text-gray-900 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter your name" />
                        @error('name')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                        <input type="text" id="price" name="price" value="{{ old('price', $item->price) }}"
                            class="
                            @error('price')
                                border-red-600
                            @enderror
                            block w-full p-4 ps-10 text-sm text-gray-900 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter your Price" />
                        @error('price')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock', $item->stock) }}"
                            class="
                            @error('stock')
                                border-red-600
                            @enderror
                            block w-full p-4 ps-10 text-sm text-gray-900 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter your Stock" />
                        @error('stock')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                        <div class="flex">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio text-blue-500" name="status" value="available"
                                    {{ $item->status == 'available' ? 'checked' : '' }}>
                                <span class="ml-2">Available</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" class="form-radio text-blue-500" name="status"
                                    value="unavailable" {{ $item->status == 'unavailable' ? 'checked' : '' }}>
                                <span class="ml-2">Unavailable</span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">
                            Select Category
                        </label>
                        <select id="category_id"
                            class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Image</label>
                        @foreach ($item->item_images as $image)
                            <img src="{{ asset('storage/itemImage/' . $image) }}" width="100px" height="100px">
                        @endforeach
                        <input type="file" id="image" name="images[]"
                            class="
                            @error('image')
                                border-red-600
                            @enderror
                            block w-full p-4 text-sm text-gray-900 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Enter your image" multiple />
                        @error('image')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <textarea id="description" rows="4" name="description"
                            class="
                            @error('description')
                                border-red-600
                            @enderror
                            block p-2.5 w-full text-sm text-gray-900 rounded-lg border focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your thoughts here...">{{ old('description', $item->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
