<?php

namespace DesafioSoftExpert\Requests;

use DesafioSoftExpert\Core\Request;
use DesafioSoftExpert\Rules\DescriptionRule;
use DesafioSoftExpert\Rules\ImageRule;
use DesafioSoftExpert\Rules\NameRule;
use DesafioSoftExpert\Rules\NumericRule;
use DesafioSoftExpert\Rules\ProductTypeRule;

class ProductRequest implements BaseRequest
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
        if ($this->request->getFile('image')['size'] != 0) {
            return [
                'name' => NameRule::validate($this->request->get('name')),
                'price' => NumericRule::validate(str_replace(',', '.', $this->request->get('price'))),
                'description' => DescriptionRule::validate($this->request->get('description')),
                'product_type' => ProductTypeRule::validate($this->request->get('product_type')),
                'image' => ImageRule::Validate($this->request->getFile('image')),
            ];
        }
        return [
            'name' => NameRule::validate($this->request->get('name')),
            'price' => NumericRule::validate(str_replace(',', '.', $this->request->get('price'))),
            'description' => DescriptionRule::validate($this->request->get('description')),
            'product_type' => ProductTypeRule::validate($this->request->get('product_type')),
        ];
    }
}