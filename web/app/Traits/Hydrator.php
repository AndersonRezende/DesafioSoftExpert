<?php

namespace DesafioSoftExpert\Traits;

trait Hydrator
{
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}