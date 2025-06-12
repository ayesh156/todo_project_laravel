
<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Image Upload</h1>

    @if(session('message'))
        <div class="mb-4 text-green-600">{{ session('message') }}</div>
    @endif

    <form action="{{ route('gallery.upload') }}" method="POST" enctype="multipart/form-data" class="mb-6">
        @csrf
        <input type="file" name="image" class="mb-2">
        @error('image') <p class="text-red-600">{{ $message }}</p> @enderror
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md">Upload</button>
    </form>

    {{-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($images as $image)
            <div>
                <img src="{{ $image }}" alt="Uploaded Image" class="w-full h-40 object-cover rounded shadow">
            </div>
        @endforeach
    </div> --}}
</div>

