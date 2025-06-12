<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="mt-8 text-2xl">
        Items
    </div>

    {{ $query }}
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
                            Edit
                            <x-danger-button wire:click="confirmItemDeletion( {{ $item->id }} )" wire:loading.attr="disabled">
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
</div>
