<?php
    echo "<?php".PHP_EOL;
?>

namespace <?php echo e($config->namespaces->livewireTables); ?>;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use <?php echo e($config->namespaces->model); ?>\<?php echo e($config->modelNames->name); ?>;

class <?php echo e($config->modelNames->plural); ?>Table extends DataTableComponent
{
    protected $model = <?php echo e($config->modelNames->name); ?>::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        <?php echo e($config->modelNames->name); ?>::find($id)->delete();
<?php if($config->options->localized): ?>
        Flash::success(__('messages.deleted', ['model' => __('models/<?php echo e($config->modelNames->camelPlural); ?>.singular')]));
<?php else: ?>
        Flash::success('<?php echo e($config->modelNames->human); ?> deleted successfully.');
<?php endif; ?>
        $this->emit('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('<?php echo e($config->primaryName); ?>');
    }

    public function columns(): array
    {
        return [
            <?php echo $columns; ?>,
            Column::make("Actions", '<?php echo e($config->primaryName); ?>')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('<?php echo e($config->modelNames->dashedPlural); ?>.show', $row-><?php echo e($config->primaryName); ?>),
                        'editUrl' => route('<?php echo e($config->modelNames->dashedPlural); ?>.edit', $row-><?php echo e($config->primaryName); ?>),
                        'recordId' => $row-><?php echo e($config->primaryName); ?>,
                    ])
                )
        ];
    }
}
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\laravel-generator\views\scaffold\table\livewire.blade.php ENDPATH**/ ?>