<?php

namespace DesafioSoftExpert\Requests;

use DesafioSoftExpert\Core\Request;
use DesafioSoftExpert\Rules\DescriptionRule;
use DesafioSoftExpert\Rules\NameRule;
use DesafioSoftExpert\Rules\NumericRule;
use DesafioSoftExpert\Rules\ProductTypeRule;

class TaxRequest implements BaseRequest
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
            'name' => NameRule::validate($this->request->get('name')),
            'value' => NumericRule::validate(str_replace(',', '.', $this->request->get('value'))),
            'product_type' => ProductTypeRule::validate($this->request->get('product_type'))
        ];
    }
}