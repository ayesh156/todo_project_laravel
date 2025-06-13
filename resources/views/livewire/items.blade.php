{{-- <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <form id="item-form" action="{{ route('items.store') }}" method="POST" class="mb-6">
        @csrf
        <input type="hidden" name="_method" value="POST" id="form-method">
        <input type="hidden" name="item_id" id="item_id" />

        <div class="flex gap-2">
            <input type="text" name="title" id="title" placeholder="Title" required
                class="w-1/3 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight" />

            <input type="text" name="description" id="description" placeholder="Description"
                class="w-1/3 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight" />

            <label class="w-1/3 flex items-center gap-2">
                <input type="checkbox" name="status" value="1" id="status" class="mr-2 leading-tight" />
                <div>
                     Active
                </div>
            </label>
        </div>

        <div class="mt-3">
            <button id="form-submit" type="submit"
                class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md">
                Add Item
            </button>
        </div>
    </form>


    <div class="mt-6">
        <div class="flex justify-between">
            <div>
                <input wire:model="q" wire:click="$set('q', '')" wire:keydown.debounce.500ms="search" type="search"
                    placeholder="Search"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
            </div>

            <div class="mr-2">
                <input type="checkbox" class="mr-2 leading-tight" wire:model.lazy="active" /> Active Only?
            </div>
        </div>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2 ml-2">
                        <div class="flex items-center">
                            <button wire:click="setSort('id')">ID</button>
                            <x-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="setSort('title')">Title</button>
                            <x-sort-icon sortField="title" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="setSort('description')">Description</button>
                            <x-sort-icon sortField="description" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    @if (!$active)
                        <th class="px-4 py-2">
                            Status
                        </th>
                    @endif
                    <th class="px-4 py-2">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $item->id }}</td>
                        <td class="border px-4 py-2">{{ $item->title }}</td>
                        <td class="border px-4 py-2">{{ $item->description }}</td>
                        @if (!$active)
                            <td class="border px-4 py-2">{{ $item->status ? 'Active' : 'Not-Active' }}</td>
                        @endif
                        <td class="border px-4 py-2">
                            <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150"
                                onclick="editItem({{ $item->id }}, '{{ $item->title }}', '{{ $item->description }}', {{ $item->status ? 'true' : 'false' }})">
                                Edit
                            </button>
                            <x-danger-button wire:click="confirmItemDeletion( {{ $item->id }} )"
                                wire:loading.attr="disabled">
                                Delete
                            </x-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $items->links() }}
    </div>


    <script>
    function editItem(id, title, description, status) {
        document.getElementById('item_id').value = id;
        document.getElementById('title').value = title;
        document.getElementById('description').value = description;
        document.getElementById('status').checked = status;

        const form = document.getElementById('item-form');
        form.action = `/items/${id}`;
        document.getElementById('form-method').value = 'PUT';
        document.getElementById('form-submit').innerText = 'Update Item';
    }
</script>

@if(session('message'))
    <div class="mt-4 text-green-600">{{ session('message') }}</div>
    <script>
        setTimeout(() => {
            document.getElementById('item_id').value = '';
            document.getElementById('title').value = '';
            document.getElementById('description').value = '';
            document.getElementById('status').checked = false;
            document.getElementById('item-form').action = '{{ route('items.store') }}';
            document.getElementById('form-method').value = 'POST';
            document.getElementById('form-submit').innerText = 'Add Item';
        }, 100);
    </script>
@endif
</div>

 --}}

 @extends('layouts.app')

@section('content')
    @include('include.items')
@endsection