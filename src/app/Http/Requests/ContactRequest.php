<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        'last_name' => 'required',
        'first_name' => 'required',
        'gender' => 'required',
        'email' => ['required', 'email'],
        'tel1' => ['nullable'],
        'tel2' => ['nullable'],
        'tel3' => ['nullable'],
        'phone' => ['tel_required'],
        'address' => 'required',
        'category_id' => 'required',
        'detail' => ['required','max:120']
    ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $tel1 = $this->input('tel1');
            $tel2 = $this->input('tel2');
            $tel3 = $this->input('tel3');

            // すべて空欄のときのエラー
            if (empty($tel1) && empty($tel2) && empty($tel3)) {
                $validator->errors()->add('tel_group', '電話番号を入力してください');
            }

            // どれか1つでも未入力の場合のエラー
            if ((empty($tel1)) || (empty($tel2) || empty($tel3)) ) {
                $validator->errors()->add('tel_group', '電話番号を入力してください');
            }

            // どれか１つでも6桁以上の場合
            if ((strlen($tel1) > 5) || (strlen($tel2) > 5) || (strlen($tel3) > 5)) {
                $validator->errors()->add('tel_group', '電話番号は5桁までの数字で入力してください');
            }

            if ((!is_numeric($tel1)) || (!is_numeric($tel2)) || (!is_numeric($tel3))) {
                $validator->errors()->add('tel_group', '電話番号は5桁までの数字で入力してください');
            }
        });
    }

    public function messages() {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください'
        ];
    }
}
