<?php

namespace App\Http\Requests\Url;

use Illuminate\Foundation\Http\FormRequest;

class CreateUrlShortenedRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'url_complete' => 'required',
            'shortened' => $this->isEmptyString('shortened')
                                        ? 'nullable' : 'nullable|unique:urls,shortened',
            'expiration_date' => 'nullable|date'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'url_complete.required' => 'É necessário enviar uma URL.',
            'shortened.unique'      => 'A URL sugerida não pode ser utilizada. Favor fornecer outra URL ou enviar em branco.'
        ];
    }
}
