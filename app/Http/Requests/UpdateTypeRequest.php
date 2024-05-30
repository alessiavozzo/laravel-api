<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeRequest extends FormRequest
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
        /* anche qui memorizzo il nome del form nella sessione che però è diverso per ogni campo che devo editare*/
        $this->session()->flash('form-name', "form-edit-{$this->type->id}");
        return [
            'name' => 'required|min:2|max:50',
            'description'=> 'nullable|max:500'
        ];
    }
}
