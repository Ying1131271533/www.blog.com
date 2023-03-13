<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class CommentRequest extends FormRequest
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
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'parent_id.required' => '要回复的评论id不能为空',
            'parent_id.integer'  => '要回复的评论id必须为数字',
            'content.unique'     => '你已经发布过此评论',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'parent_id' => 'required|integer',
            'content'   => [
                'required',
                'max:255',
                Rule::unique('comments')
                ->where('user_id', auth()->id())
                ->where('blog_id', $this->blog_id), // 用户是否发布过相同的评论内容
            ],
        ];
    }
}
