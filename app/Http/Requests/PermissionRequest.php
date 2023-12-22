<?php
namespace App\Http\Requests;
use Str;
use Illuminate\Foundation\Http\FormRequest;
class PermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $this->request->add([
            'name' => Str::slug($this->input('name'), '_'),
        ]);
        switch ($this->input('type')) {
            case 'role':
                $rules['name'] = ($this->input('name') != $this->input('oldname')) ? 'required|unique:roles,name|max:255' : 'required|max:255';
                break;
            case 'group':
                $rules['name'] = ($this->input('name') != $this->input('oldname')) ? 'required|unique:group_permissions,name|max:255' : 'required|max:255';
                break;
            default:
                # code...
                break;
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Thuộc tính tên không được để trống',
            'name.unique' => 'Thuộc tính tên đã tồn tại',
            'name.max:255' => 'Thuộc tính tên không được quá 255 ký tự'
        ];
    }
}

