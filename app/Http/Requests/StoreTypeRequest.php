<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /* memorizzo il nome del form nella sessione */
        session()->flash('form-name', 'form-new');
        return [
            'name' => 'required|min:2|max:50',
            'description'=> 'nullable|max:500'
        ];
    }
}
