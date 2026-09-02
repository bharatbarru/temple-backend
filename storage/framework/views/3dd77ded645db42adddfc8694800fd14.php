<?php
    echo "<?php".PHP_EOL;
?>

namespace <?php echo e(config('laravel_generator.namespace.request')); ?>;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('user');
        $rules = [
          'name'     => 'required',
          'email'    => 'required|email|unique:users,email,'.$id,
          'password' => 'confirmed'
        ];
        
        return $rules;
    }
}
<?php /**PATH C:\Users\PSHCPU008\Desktop\temple-backend\vendor\infyomlabs\laravel-generator\views\scaffold\user\update_user_request.blade.php ENDPATH**/ ?>