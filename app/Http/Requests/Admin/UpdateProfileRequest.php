namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use App\Rules\SafeName;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null; //ログイン済みなら許可
    }

    public function rules(): array
    {
        $id = $this->user()->id;

        return [
            'name' => ['required', 'max:30', new SafeName],
            'email' => ['required', 'email', "unique:users,email,$id"],
            'password' => ['nullable', 'confirmed', Password::defaults()], // パス変更しない場合は空欄OK(nullable)。入力したら confirmed で一致チェック
        ];
    }
}