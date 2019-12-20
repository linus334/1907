<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ArticlePost extends FormRequest
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
        return [
            'title' => [
                'required',
                Rule::unique('article')->ignore(request()->title,'title'),
                ],
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'标题必填',
            'title.unique'=>'标题已存在',
            'type_id.required'=>'文章分类必填',
            'important.required'=>'文章重要性必填',
            'display.required'=>'是否显示必填',
        ];
    }
}
