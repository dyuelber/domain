<?php

namespace Tests\Unit;

use App\Exceptions\MissingParameterException;
use App\Models\Domain;
use App\Services\AbstractService;
use App\Services\DomainService;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class DomainTest extends TestCase
{
    protected AbstractService $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = new DomainService();
    }

    /**
     * @test
     */
    public function should_error_create()
    {
        $this->expectException(MissingParameterException::class);

        $this->service->create([
            'current' => null,
        ]);

        $this->assertDatabaseMissing('domains', [
            'current' => null,
        ]);
    }

    /**
     * @test
     */
    public function create_domain_succesfull()
    {
        Cache::spy();

        $current = fake()->domainName();

        Cache::shouldReceive('put')->with(['current' => $current]);

        $this->service->create([
            'current' => $current,
        ]);

        $this->assertDatabaseHas('domains', [
            'current' => $current,
        ]);
    }

    /**
     * @test
     */
    public function should_error_update()
    {
        $this->expectException(MissingParameterException::class);

        $domain = Domain::factory()->create();

        $this->service->update([
            'current' => null,
            'old' => $domain->current,
        ], $domain->current);

        $this->assertDatabaseHas('domains', [
            'current' => $domain->current,
            'old' => null,
        ]);
    }

    /**
     * @test
     */
    public function update_domain_succesfull()
    {
        $domain = Domain::factory()->create();
        $newDomain = fake()->domainName();

        $this->service->update([
            'current' => $newDomain,
            'old' => $domain->current,
        ], $domain->current);

        $this->assertDatabaseHas('domains', [
            'current' => $newDomain,
            'old' => $domain->current,
        ]);
    }
}
