<?php

namespace DesafioSoftExpert\Requests;

use DesafioSoftExpert\Core\Request;
use DesafioSoftExpert\Rules\DescriptionRule;
use DesafioSoftExpert\Rules\ImageRule;
use DesafioSoftExpert\Rules\NameRule;
use DesafioSoftExpert\Rules\NumericRule;
use DesafioSoftExpert\Rules\ProductTypeRule;

class SaleRequest implements BaseRequest
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
        $items = $this->adjustRequestData();
        $result = [];
        foreach ($items as $item) {
            if (!intval($item)) {
                $result[] = $item;
            }
        }
        return $result;
    }

    public function adjustRequestData()
    {
        return array_filter($this->request->getPostVars(), function($quantity) {
            return $quantity !== '0';
        });
    }
}