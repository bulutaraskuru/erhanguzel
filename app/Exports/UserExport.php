<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{
    protected $all;

    public function __construct($all)
    {
        $this->all = $all;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $roles = ! empty($this->all['roles']) ? $this->all['roles'] : '';
        $is_active = ! empty($this->all['is_active']) ? $this->all['is_active'] : '';

        $query = User::with('roles');

        if ($this->all['roles'] != 'all') {
            $query->role($roles);
        }

        if ($this->all['is_active'] != 'all') {
            $query->where('is_active', $is_active);
        }
        $data = $query->orderby('name', 'asc')->get();

        return view('exports.user_export_excel', [
            'users' => $data,
        ]);
    }
}
