<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xl font-bold">Todo Application Dashboard</h2>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold text-sm rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    Log Out
                </button>
            </form>
        </div>
        <!-- Redirect to post-create -->
        <a href="{{ route('post.create') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold text-sm rounded hover:bg-blue-700">
            Go to Post Create
        </a>
    </div>
</body>

</html>
