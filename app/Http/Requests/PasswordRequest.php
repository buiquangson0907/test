<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class PasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password' => ($this->input('password') != NULL) ? 'min:6|max:32' : 'required',
            'passwordagain' => 'same:password',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải từ 6 ký tự trở lên!',
            'password.max' => 'Mật khẩu tối đa 32 ký tự!',
            'passwordagain.same' => 'Xác nhận mật khẩu không giống nhau.'
        ];
    }

}
