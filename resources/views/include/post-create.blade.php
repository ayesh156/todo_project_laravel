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

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Form Section -->
                <div class="w-full lg:w-1/2">
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data"
                        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        @csrf
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center border-b pb-2 relative">
                            📝 New Post
                            <span
                                class="absolute left-1/2 transform -translate-x-1/2 bottom-0 w-16 h-1 bg-blue-500 rounded-full"></span>
                        </h2>

                        <!-- Title -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                            <input name="title" id="title" type="text" placeholder="Enter title"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                value="{{ old('title') }}">
                            @error('title')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Image</label>
                            <input name="image" id="image" type="file"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            @error('image')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Body -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="body">Body</label>
                            <textarea name="body" id="body" rows="5" placeholder="Enter content"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('body') }}">{{ old('body') }}</textarea>
                            @error('body')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Table Section -->
                <div class="w-full lg:w-1/2">
                    <div class="relative overflow-x-auto bg-white rounded shadow">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3">#</th>
                                    <th scope="col" class="px-6 py-3">Title</th>
                                    <th scope="col" class="px-6 py-3">Image</th>
                                    <th scope="col" class="px-6 py-3">Body</th>
                                    <th scope="col" class="px-6 py-3">Edit</th>
                                    <th scope="col" class="px-6 py-3">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr class="bg-white border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                            {{ $post->id }}</th>
                                        <td class="px-6 py-4">{{ $post->title }}</td>
                                        <td class="px-6 py-4"><img class="h-12" src="{{ asset($post->image) }}"
                                                alt=""></td>
                                        <td class="px-6 py-4">{{ $post->body }}</td>
                                        <td class="px-6 py-4"><a class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-3 rounded focus:outline-none focus:shadow-outline" href="{{ route('post.edit', $post->id) }}">Edit</a></td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('post.destroy',$post->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded focus:outline-none focus:shadow-outline">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('include.footer')
</body>

</html>
