<?php
namespace CodeSmithTech\Linford\File;

use CodeSmithTech\Linford\File\CodeGenerators\ControllerGenerator;
use CodeSmithTech\Linford\File\CodeGenerators\EntityGenerator;
use CodeSmithTech\Linford\File\CodeGenerators\MigrationGenerator;
use CodeSmithTech\Linford\File\CodeGenerators\RequestValidatorGenerator;
use CodeSmithTech\Linford\File\CodeGenerators\RouteGenerator;
use Illuminate\Support\Facades\Artisan;

class CodeGenerator
{
    public function createApiResource(array $config)
    {
        $this->createPolicy($config);
        $this->createMigration($config);
        $this->createEntity($config);
        $this->createRequestValidator($config);
        $this->createController($config);
        $this->createRoutes($config);
        $this->updateExistingEntities($config);
        
    }
    
    public function createEntity(array $config)
    {
        /** @var EntityGenerator $entityGenerator */
        $entityGenerator = app(EntityGenerator::class);
        $entityGenerator->generate($config);
        $entityGenerator->save();
    }
    
    public function createMigration(array $config)
    {
        /** @var MigrationGenerator $migrationGenerator */
        $migrationGenerator = app(MigrationGenerator::class);
        $migrationGenerator->generate($config);
        $migrationGenerator->save();
    }
    
    public function createRequestValidator(array $config)
    {
        /** @var RequestValidatorGenerator $requestGenerator */
        $requestGenerator = app(RequestValidatorGenerator::class);
        $requestGenerator->generate($config);
        $requestGenerator->save();
    }
    
    public function createController(array $config)
    {
        /** @var ControllerGenerator $controllerGenerator */
        $controllerGenerator = app(ControllerGenerator::class);
        $controllerGenerator->generate($config);
        $controllerGenerator->save();
    }
    
    public function createRoutes(array $config)
    {
        /** @var RouteGenerator $routeGenerator */
        $routeGenerator = app(RouteGenerator::class);
        $routeGenerator->generate($config);
        $routeGenerator->save();
    }
    
    public function createPolicy(array $config)
    {
        Artisan::call("make:policy {$config['name']}Policy --model=Entity/{$config['name']}");
        
        $policyDir = app_path('Entity/Policies');
        
        if (! is_dir($policyDir)) {
            mkdir($policyDir);
        }
        $newFile = "$policyDir/{$config['name']}Policy.php";
        rename(app_path("Policies/${config['name']}Policy.php"), $newFile);
        
        file_put_contents($newFile, str_replace('\\Policies', '\\Entity\\Policies', file_get_contents($newFile)));
    }
    
    public function updateExistingEntities(array $config)
    {
    
    }
}