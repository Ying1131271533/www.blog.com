<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UserRequest extends FormRequest
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
     * 验证场景
     *
     * @return array
     */
    protected function scene()
    {
        // 获取路由名称
        $routeName = Route::current()->action['as'];
        switch ($routeName) {
            case 'user.infoUpdate':
                return [
                    'name'  => 'required|min:4|max:32',
                    'email' => 'required|email',
                ];
                break;
            case 'user.avatarUpdate':
                return [
                    'avatar'  => 'required|image|dimensions:min_width=50,min_height=50,max_width=500,max_height=500',
                ];
                break;
            default:
                return ['validate_error' => 'required'];
                break;

        }
    }
}
