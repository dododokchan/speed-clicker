<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SafeName implements ValidationRule
{
    /** NGワード */
    protected array $banned = ['死ね', 'fuck', 'sex', 'shit'];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //文字（ひらがなカタカナ漢字英数 _-）を許可
        if (!preg_match('/^[\p{L}\p{N}_\-ぁ-んァ-ヶー一-龠]+$/u', $value)) {
            $fail('使用できない文字が含まれています。');
            return;
        }

        //NGワード
        foreach ($this->banned as $word) {
            if (stripos($value, $word) !== false) {
                $fail("不適切な語句 '{$word}' が含まれています。");
                return;
            }
        }
    }

    public function message(): string
    {
        return '使用できない文字、または不適切な語句が含まれています。';
    }
}
