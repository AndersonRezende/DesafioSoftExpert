<?php

namespace DesafioSoftExpert\Requests;

use DesafioSoftExpert\Core\Request;
use DesafioSoftExpert\Rules\EmailRule;
use DesafioSoftExpert\Rules\NameRule;
use DesafioSoftExpert\Rules\PasswordConfirmationRule;
use DesafioSoftExpert\Rules\PasswordRule;

class AuthRegisterRequest implements BaseRequest
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
            'email' => EmailRule::validate($this->request->get('email')),
            'password' => PasswordRule::validate($this->request->get('password')),
            'confirm_password' => PasswordConfirmationRule::validate(
                [$this->request->get('password'), $this->request->get('confirm_password')]
            ),
        ];
    }
}