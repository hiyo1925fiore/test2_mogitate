<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'price' => 'required | numeric | min:0 | max:10000',
            'image' => 'required | mimes:png,jpeg',
            'season_id' => 'required',
            'description' => 'required | max:120'
        ];

        //商品を追加する、または詳細画面で画像を更新する場合
        if (!$this->route('id') || $this->hasFile('image')) {
            $rules['image'] = 'required | mimes:png,jpeg';
        } else {
        // 詳細画面で画像を更新せずに変更を保存する場合
            $rules['image'] = 'nullable | mimes:png,jpeg';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.min' => '0~10000円以内で入力してください',
            'price.max' => '0~10000円以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'season_id.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください'
        ];
    }
}
