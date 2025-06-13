<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold">Todo Application</h2>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold text-sm rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Log Out
            </button>
        </form>
    </div>
</div>
