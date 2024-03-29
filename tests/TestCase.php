<?php

namespace Tests;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param UserContract $user
     * @param $abilities
     * @return TestCase|$this
     */
    public function actingAs(UserContract $user, $abilities = ['*']): TestCase|static
    {
        Sanctum::actingAs($user, $abilities);

        return $this;
    }
}
