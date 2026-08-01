<?php

namespace App\Http\Livewire;

use App\Http\Controllers\UserManagement\PermissionController;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Permission;

class PermissionsTable extends DataTableComponent
{
    protected $model = Permission::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $permission = new PermissionController();
        $permission->destroy($id);
    }

    public function resetCounter()
    {
        $this->i = 1;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->resetCounter();
    }

    public function columns(): array
    {
        return [
            Column::make('S.no', 'id')
                ->format(fn ()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => null,
                        'editUrl' => route('permissions.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'permissions'
                    ])
                )
        ];
    }

    public function builder(): Builder
    {
        return Permission::query()
            ->where('type', 1);
    }
}
