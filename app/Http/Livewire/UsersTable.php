<?php

namespace App\Http\Livewire;

use App\Http\Controllers\UserManagement\UserController;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use App\Models\User;
use App\Repositories\UserRepository;
use Spatie\Permission\Models\Role;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $userRepo = new UserRepository();
        $user = new UserController($userRepo);
        $user->destroy($id);
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
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Mobile", "mobile")
                ->sortable()
                ->searchable(),
            Column::make("Address", "address")
                ->sortable()
                ->searchable(),
            Column::make("Role", "id")
                ->format(fn ($id)  => getUserRole($id)),
            Column::make("Reset Password", "id")
                ->format(function ($id) {
                    echo '<a href=' . url('admin/users/reset/' . $id) . ' class="btn btn-info table-btn">Reset Password</a>';
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('users.show', $row->id),
                        'editUrl' => route('users.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'users'
                    ])
                )
        ];
    }

    public function filters(): array
    {
        $roles = Role::all()->pluck('name', 'id');
        return [
            SelectFilter::make('Role')
                ->options(['' => 'Select Role', $roles])
                ->filter(function (Builder $builder, $value) {
                    $builder->where('roles.id', $value);
                }),
        ];
    }

    public function builder(): Builder
    {
        return User::join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->select('users.*');
    }
}