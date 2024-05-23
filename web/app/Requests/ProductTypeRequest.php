<?php

namespace DesafioSoftExpert\Requests;

use DesafioSoftExpert\Core\Request;
use DesafioSoftExpert\Requests\BaseRequest;
use DesafioSoftExpert\Rules\NameRule;

class ProductTypeRequest implements BaseRequest
{

    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate()
    {
        $data = array_filter($this->rules(), function($value) {
            return $value === false;
        });
        return empty($data) ? true : ['error' => $data];
    }

    public function rules(): array
    {
        return [
            'name' => NameRule::validate($this->request->get('name'))
        ];
    }
}