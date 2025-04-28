<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingFetchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'start_date'    => 'required|date',
            'end_date'      => 'required|date',
            'guest_count'   => 'required|integer|min:1',
        ];
    }
}
