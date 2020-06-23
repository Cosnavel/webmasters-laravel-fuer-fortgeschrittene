<?php

namespace App\Services;

use App\Exceptions\CalcException;

class CalcService
{
    public function plus($x, $y)
    {
        $this->validate($x, $y);

        return $x + $y;
    }

    public function toThePowerOf($x, $y)
    {
        $this->validate($x, $y);

        return $x ** $y;
    }

    private function validate($x, $y)
    {
        if (! is_numeric($x) | ! is_numeric($y)) {
            throw new CalcException('invalid arguments - they have to be numeric');
        }
    }
}
