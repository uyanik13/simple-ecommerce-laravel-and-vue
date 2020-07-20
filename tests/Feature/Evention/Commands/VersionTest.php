<?php

namespace Tests\Feature\Evention\Commands;

use Evention\Facades\Evention;
use Tests\TestCase;

class VersionTest extends TestCase
{
    /**
     * Example test for check application status
     *
     * @return void
     */
    public function testCommandResult()
    {
        $this->artisan('evention:version')
            ->expectsOutput('Evention Shop CMS ' . Evention::version());
    }
}
