<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="<?php echo e($config->modelNames->dashedPlural); ?>-table">
            <thead>
            <tr>
                <?php echo $fieldHeaders; ?>

<?php if($config->options->localized): ?>
                <th colspan="3"><?php echo app('translator')->get('crud.action'); ?></th>
<?php else: ?>
                <th colspan="3">Action</th>
<?php endif; ?>
            </tr>
            </thead>
            <tbody>
            @foreach($<?php echo e($config->modelNames->camelPlural); ?> as $<?php echo e($config->modelNames->camel); ?>)
                <tr>
                    <?php echo $fieldBody; ?>

                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['<?php echo e($config->prefixes->getRoutePrefixWith('.')); ?><?php echo e($config->modelNames->camelPlural); ?>.destroy', $<?php echo e($config->modelNames->camel); ?>-><?php echo e($config->primaryName); ?>], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('<?php echo $config->prefixes->getRoutePrefixWith('.'); ?><?php echo $config->modelNames->camelPlural; ?>.show', [$<?php echo $config->modelNames->camel; ?>-><?php echo $config->primaryName; ?>]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('<?php echo $config->prefixes->getRoutePrefixWith('.'); ?><?php echo $config->modelNames->camelPlural; ?>.edit', [$<?php echo $config->modelNames->camel; ?>-><?php echo $config->primaryName; ?>]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            <?php echo $paginate; ?>

        </div>
    </div>
</div>
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\adminlte-templates\views\templates\scaffold\table\blade\body.blade.php ENDPATH**/ ?>