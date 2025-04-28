<?php

// app/Http/Requests/BookingRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'start_date'        => 'required|date',
            'end_date'          => 'required|date',
            'guest_count'       => 'required|integer|min:1',
            'room_id'           => 'required|exists:rooms,id'
        ];
    }
}
