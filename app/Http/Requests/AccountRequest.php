<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class AccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $rules = [
            'name' => 'required|min:5',
            'passwordagain' => 'same:password'
        ];
        if ($this->input('update') == 1) {
            $rules['name'] = ($this->input('name') != $this->input('oldname')) ? 'min:5|unique:admins,name' : 'min:5';
            $rules['email'] = ($this->input('email') != $this->input('oldemail')) ? 'email|unique:admins,email' : '';
            $rules['password'] = ($this->input('password') != NULL) ? 'min:6|max:32' : '';
        }else{
            $rules['name'] = 'required|min:5|unique:admins,name';
            $rules['email'] = 'required|email|unique:admins,email';
            $rules['password'] = 'max:32';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.unique' =>'Tên đã tồn tại.',
            'name.required' => 'Tên tài khoản không được để trống.',
            'name.min' => 'Tên tài khoản chứa ít nhất 5 ký tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' =>'Email đã tồn tại.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải từ 6 ký tự trở lên!',
            'password.max' => 'Mật khẩu tối đa 32 ký tự!',
            'passwordagain.same' => 'Xác nhận mật khẩu không giống nhau.'
        ];
    }
}

