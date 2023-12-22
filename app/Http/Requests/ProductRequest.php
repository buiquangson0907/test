<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Str;
class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        if (!$this->input('slug')) {
            $this->request->add([
                'slug' => Str::slug($this->input('name'), '-'),
            ]);
        }
        $rules = [];
        $rules['name'] = ($this->input('name') != $this->input('oldname')) ? 'required|min:5|max:255|unique:products,name' : 'required|max:255';
        $rules['slug'] = ($this->input('slug') != $this->input('oldslug')) ? 'required|min:5|max:255|unique:products,slug' : 'required|max:255';
        return $rules;
    }
    public function messages()
    {
        return [
            'name.unique' =>'Tên sản phẩm đã tồn tại.',
            'name.required' => 'Tên sản phẩm không được để trống.',
            'name.min' => 'Tên sản phẩm chứa ít nhất 5 ký tự.',
            'name.max' => 'Tên sản phẩm chứa ít nhất 5 ký tự.',

            'slug.unique' =>'Đường dẫn đã tồn tại.',
            'slug.required' => 'Đường dẫn không được để trống.',
            'slug.min' => 'Đường dẫn chứa ít nhất 5 ký tự.',
            'slug.max' => 'Đường dẫn chứa ít nhất 5 ký tự.',
        ];
    }
}

