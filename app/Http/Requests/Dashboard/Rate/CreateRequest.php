<?php

namespace App\Http\Requests\Dashboard\Rate;

use App\Http\Requests\Dashboard\BaseRequest;

class CreateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'name'      => 'required|string|max:255',
            'price'     => 'required|integer',
            'default'   => 'nullable|boolean'
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'     => 'Необходимо ввести имя название тарифа.',
            'name.string'       => 'Название тарифа должно быть строкой.',
            'name.max'          => 'Название тарифа должно содержать в себе не более 255 символов.',
            'price.required'    => 'Необходимо ввести стоимость тарифа.',
            'price.integer'     => 'Стоимость тарифа должна быть числом',
            'default.boolean'   => 'Значение влага не булевое'
        ];
    }
}