<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e(config('app.name')); ?></title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <?php echo app('Illuminate\Foundation\Vite')('resources/sass/app.scss'); ?>
    <?php echo $__env->yieldPushContent('third_party_stylesheets'); ?>
    <?php echo $__env->yieldPushContent('page_css'); ?>

</head>

<?php echo e($slot); ?>


<?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
<?php echo $__env->yieldPushContent('third_party_scripts'); ?>
<?php echo $__env->yieldPushContent('page_scripts'); ?>

</html>
<?php /**PATH C:\Users\DELL\Desktop\laravel-backup-20260801\laravel\vendor\infyomlabs\laravel-ui-adminlte\src/../resources/views/components/adminlte-layout.blade.php ENDPATH**/ ?>