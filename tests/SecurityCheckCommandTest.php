<?php

namespace Enlightn\LaravelSecurityChecker\Tests;

use Enlightn\LaravelSecurityChecker\ServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class SecurityCheckCommandTest extends OrchestraTestCase
{
    /**
     * @test
     */
    public function detects_vulnerabilities()
    {
        $lockFile = $this->getFixturesDirectory().DIRECTORY_SEPARATOR.'vulnerable.lock';

        $this->artisan('security:check', ['lockfile' => $lockFile])
            ->assertExitCode(1);
    }

    /**
     * @test
     */
    public function passes_with_no_vulnerabilities()
    {
        $lockFile = $this->getFixturesDirectory().DIRECTORY_SEPARATOR.'safe.lock';

        $this->artisan('security:check', ['lockfile' => $lockFile])
            ->assertExitCode(0);
    }

    /**
     * @test
     */
    public function detects_vulnerabilities_in_dev_packages()
    {
        $lockFile = $this->getFixturesDirectory().DIRECTORY_SEPARATOR.'vulnerable-dev.lock';

        $this->artisan('security:check', ['lockfile' => $lockFile])
            ->assertExitCode(1);
    }

    /**
     * @test
     */
    public function can_ignore_vulnerabilities_in_dev_packages()
    {
        $lockFile = $this->getFixturesDirectory().DIRECTORY_SEPARATOR.'vulnerable-dev.lock';

        $this->artisan('security:check', ['lockfile' => $lockFile, '--no-dev' => true])
            ->assertExitCode(0);
    }

    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    protected function getFixturesDirectory()
    {
        return __DIR__.DIRECTORY_SEPARATOR.'Fixtures';
    }
}