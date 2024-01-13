<?php

namespace App\Dtos;

class BaseDto
{
    public function __construct(...$args)
    {
    }

    public static function fromRequest(array $data)
    {
        return new static(...$data);
    }
}
