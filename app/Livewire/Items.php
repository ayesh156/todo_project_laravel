<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Items extends Component
{
    use WithPagination;

    public $active = false;
    public $q = '';
    public $sortBy = 'id';
    public $sortAsc = true;

    protected $queryString = [
        'active' => ['except' => false],
        'q' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true],
    ];

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }

    public function updatingActive()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Item::where('user_id', Auth::id());

        // Apply search filter
        if (!empty($this->q)) {
            $query->search($this->q);
        }

        // Apply active filter
        if ($this->active) {
            $query->active();
        }

        // Apply ordering
        $query->orderBy($this->sortBy, $this->sortAsc ? 'asc' : 'desc');

        // For debugging the SQL query
        $rawSql = $query->toSql();

        $items = $query->paginate(10);

        return view('livewire.items', [
            'items' => $items,
            'query' => $rawSql
        ]);
    }

    public function setSort($field)
    {
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }

    public function confirmItemDeletion(Item $item)
    {
        $item -> delete();
    }
}
