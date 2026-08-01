<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;

class HandleForeignKeyConstraintViolation
{
    public static function handle(QueryException $e, $redirectRoute)
    {
        $errorCode = $e->errorInfo[1];
        if ($errorCode == 1451) {
            // foreign key constraint violation
            flash()->error('Cannot delete record because it has related records in another table.');
            return redirect(route($redirectRoute));
        } else {
            // other database error
            flash()->error('Error deleting record: ' . $e->getMessage());
            return redirect(route($redirectRoute));
        }
    }
}
