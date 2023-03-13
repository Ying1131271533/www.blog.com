<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
        return $this->scene();
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_id.gt'      => '请选择分类',
            'category_id.integer' => '请选择分类',
        ];
    }

    /**
     * 验证场景
     *
     * @return array
     */
    protected function scene()
    {
        // 获取路由名称
        $routeName = Route::current()->action['as'];
        switch ($routeName) {
            case 'blog.store':
                return [
                    'user_id'     => 'required|integer|gt:0|exists:users,id',
                    'category_id' => 'required|integer|gt:0|exists:categorys,id',
                    'title'       => 'required|min:2|max:50|unique:blogs',
                    'content'     => 'required|min:4',
                ];
                break;
            case 'blog.update':
                return [
                    'id'          => 'required|integer|gt:0',
                    'user_id'     => 'required|integer|gt:0|exists:users,id',
                    'category_id' => 'required|integer|gt:0|exists:categorys,id',
                    'title'       => [
                        'required',
                        'min:2',
                        'max:50',
                        Rule::unique('blogs')->ignore($this->id), // 检查唯一性时，排除自己
                    ],
                    'content'     => 'required|min:4',
                ];
                break;
            default:
                return ['validate_error' => 'required'];
                break;

        }
    }
}
