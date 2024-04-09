<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeServiceClasses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Filesystem instance.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Create a new command instance.
     *
     * @param  Filesystem  $filesystem
     * @return void
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $name = $this->argument('name');
        $class_name = $this->getClassName($name);
        $stub_contents = $this->getStubContents();

        $this->createServiceFile($class_name, $stub_contents);

        $this->info('Service class created successfully.');
    }

    /**
     * Get class name from the provided name.
     *
     * @param  string  $name
     * @return string
     */
    protected function getClassName(string $name): string
    {
        return Str::studly($name);
    }

    /**
     * Get the contents of the service stub file.
     *
     * @return string
     * @throws FileNotFoundException
     */
    protected function getStubContents(): string
    {
        return $this->filesystem->get(resource_path('stubs/service.stub'));
    }

    /**
     * Create the service class file.
     *
     * @param  string  $class_name
     * @param  string  $stub_contents
     * @return void
     */
    protected function createServiceFile(string $class_name, string $stub_contents): void
    {
        $path = app_path('Services/' . $class_name . '.php');

        if ($this->filesystem->exists($path)) {
            $this->error('Service class already exists!');
            return;
        }

        $this->filesystem->put($path, str_replace('{{class}}', $class_name, $stub_contents));
    }
}
