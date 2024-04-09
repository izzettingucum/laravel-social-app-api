<?php

namespace App\Strategies\Interfaces;

interface ViewProfileStrategyInterface
{
    /**
     * @param string $slug
     * @return mixed
     */
    public function viewProfile(string $slug): mixed;
}
