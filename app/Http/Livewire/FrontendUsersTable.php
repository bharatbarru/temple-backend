<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FrontendUserController;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\FrontendUser;
use App\Repositories\FrontendUserRepository;

class FrontendUsersTable extends DataTableComponent
{
    protected $model = FrontendUser::class;
    public $i = 1;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        $frontendUserRepo = new FrontendUserRepository();
        $frontendUser = new FrontendUserController($frontendUserRepo);
        $frontendUser->destroy($id);
    }

    public function resetCounter()
    {
        $this->i = 1;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setSingleSortingDisabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->resetCounter();
    }

    public function columns(): array
    {
        return [
            Column::make('S.no', 'id')
                ->format(fn()  => ($this->page - 1) * $this->perPage + $this->i++),
            Column::make("First Name", "first_name")
                ->sortable()
                ->searchable(),
            Column::make("Last Name", "last_name")
                ->sortable()
                ->searchable(),
            Column::make("Mobile", "mobile")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Address", "address")
                ->sortable()
                ->searchable(),
            Column::make("Country", "country")
                ->sortable()
                ->searchable(),
            Column::make("State", "state")
                ->sortable()
                ->searchable(),
            Column::make("City", "city")
                ->sortable()
                ->searchable(),
            Column::make("Pincode", "pincode")
                ->sortable()
                ->searchable(),
            Column::make("Publish", "publish")
                ->format(function ($publish, $frontendUser) {
                    return view('common.livewire-tables.publish', ['publish' => $publish, 'id' => $frontendUser->id]);
                }),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('frontendUsers.show', $row->id),
                        'editUrl' => route('frontendUsers.edit', $row->id),
                        'recordId' => $row->id,
                        'permissionName' => 'frontend-users'
                    ])
                )
        ];
    }

    public function togglePublish($id)
    {
        $frontendUser = FrontendUser::find($id);
        $frontendUser->publish = !$frontendUser->publish;
        $frontendUser->save();
    }
}
