<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoreStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 認証は middleware で済むので true
        return true;
    }

    public function rules(): array
    {
        return [
            // 平均スコアは 0 より大きい小数（ms）
            'average_score' => ['required', 'numeric', 'min:0'],
        ];
    }
}
