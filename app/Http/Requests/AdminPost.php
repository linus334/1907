<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class AdminPost extends FormRequest
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
        return ['admin_name' =>
                'required',
                Rule::unique('admin')->ignore(request()->id,'admin_id'),

                'admin_pwd' => 'required',
        ];
    }
    //获取被定义规则的错误信息
    public function messages(){
        return [
            'admin_name.required'=>'管理员名称必填',
            'brand_name.unique'=>'管理员名称已存在',
            'admin_pwd.required'=>'管理员密码必填'
        ];
    }
}
