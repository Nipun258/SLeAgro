<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ArrayAtLeastOneRequired implements Rule
{

    private string $key;
    private string $value;

   public function passes($attribute, $value): bool
    {
        // remove null items from collection.
        $arr = collect($value)->filter(); 

        return $arr->isNotEmpty();
    }

    public function message()
    {
        return 'One product need be booking.';
    }
}
