<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required | max:100 | email',
            'password' => 'required | min:8 | max:100 | string',
            'email_verified_at' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.max' => '名前を100文字以内で入力してください',
            'name.string' => '名前を文字列で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.max' => 'メールアドレスを255文字以下で入力してください',
            'email.email' => 'メールアドレスをメール方式で入力してください',
            'email.unique' => 'ほかのメールアドレスを指定してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードを8文字以上で入力してください',
            'password.max' => 'パスワードを100文字以内で入力してください',
            'password.string' => 'パスワードを文字列で入力してください',
            'password.confirmed' => 'パスワードが一致しません',
            'email_verified_at.required' => 'メール認証が完了していません。',
        ];
    }
}
