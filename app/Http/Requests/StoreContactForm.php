<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // trueしないと今のアプリ的には動かない
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * バリエーションルール
     * @return array<string, mixed>
     */
    public function rules()
    {
        // 同じ人の複数問い合わせを想定してEMAILにはユニーク判定をかけない
        return [
            //
            'your_name' => 'required|string|max:20',
            'title'     => 'required|string|max:50',
            'email'     => 'required|email|max:255',
            'url'       => 'url|nullable',
            'gender'    => 'required',
            'age'       => 'required',
            'contact'   => 'required|string|max:200',
            'caution'   => 'required|accepted'
        ];
    }
}
