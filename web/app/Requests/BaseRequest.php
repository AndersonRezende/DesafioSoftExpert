<?php

namespace DesafioSoftExpert\Requests;

interface BaseRequest
{
    public function validate();

    public function rules(): array;
}