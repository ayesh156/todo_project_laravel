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

    protected $queryString = [
        'active',
        'q'
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

        // For debugging the SQL query
        $rawSql = $query->toSql();

        $items = $query->paginate(10);

        return view('livewire.items', [
            'items' => $items,
            'query' => $rawSql
        ]);
    }
}
