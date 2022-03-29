<?php

namespace App\Services\Apartment\Show;

class ShowApartmentRequest
{
    private int $id;

    public function __construct(int $id)
    {

        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}