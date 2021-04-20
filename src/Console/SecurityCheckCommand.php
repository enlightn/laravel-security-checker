<?php

namespace Enlightn\LaravelSecurityChecker\Console;

use Enlightn\SecurityChecker\AnsiFormatter;
use Enlightn\SecurityChecker\JsonFormatter;
use Enlightn\SecurityChecker\SecurityChecker;
use Illuminate\Console\Command;
use Throwable;

class SecurityCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'security:check
                            {lockfile=composer.lock : The path of the composer.lock file}
                            {--format=ansi : The output format of the command}
                            {--temp-dir= : The temp directory to use for caching}
                            {--no-dev : Exclude dev dependencies from scanning}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan your application dependencies for known security vulnerabilities';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $formatter = $this->option('format') === 'ansi' ? new AnsiFormatter : new JsonFormatter;

        $excludeDev = $this->option('no-dev');

        $tempDir = $this->option('temp-dir');

        try {
            $result = (new SecurityChecker($tempDir))->check($this->argument('lockfile'), $excludeDev);

            $formatter->displayResult($this->getOutput(), $result);
        } catch (Throwable $throwable) {
            $formatter->displayError($this->getOutput(), $throwable);

            return 1;
        }

        if (count($result) > 0) {
            return 1;
        }

        return 0;
    }
}