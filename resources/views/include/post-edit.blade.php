<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @include('include.header')
    <section class="py-8">
        <div class="container mx-auto px-4 max-w-7xl">
            @if (session()->has('success'))
                <div class="text-green-600 mb-4">
                    {{ session()->get('message') }}
                </div>
            @endif

            <div class="flex flex-col">
                <!-- Form Section -->
                <div class="w-full lg:w-1/2">
                    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data"
                        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        @csrf
                        @method('PUT')
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center border-b pb-2 relative">
                            📝 Edit Post
                            <span
                                class="absolute left-1/2 transform -translate-x-1/2 bottom-0 w-16 h-1 bg-blue-500 rounded-full"></span>
                        </h2>

                        <!-- Title -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                            <input name="title" id="title" type="text" placeholder="Enter title"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                value="{{ $post->title }}">
                            @error('title')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Image</label>
                            <input name="image" id="image" type="file"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            <img  class="h-12 mt-2" src="{{ asset($post->image) }}" alt="">
                            @error('image')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Body -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="body">Body</label>
                            <textarea name="body" id="body" rows="5" placeholder="Enter content"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $post->body }}">{{ $post->body }}</textarea>
                            @error('body')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-black hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('include.footer')
</body>

</html>
