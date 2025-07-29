<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SafeName implements ValidationRule
{
    /** NGワード */
    protected array $banned = ['死ね', 'fuck', 'sex', 'shit'];

    public function passes($attribute, $value): bool
    {
        //文字（ひらがなカタカナ漢字英数 _-）を許可
        if (!preg_match('/^[\p{L}\p{N}_\-ぁ-んァ-ヶー一-龠]+$/u', $value)) {
            return false;
        }
        //NGワード
        foreach ($this->banned as $word) {
            if (stripos($value, $word) !== false) {
                return false;
            }
        }
        return true;
    }

    public function message(): string
    {
        return '使用できない文字、または不適切な語句が含まれています。';
    }
}
