<?php
namespace CodeSmithTech\Linford\File\CodeGenerators;

use Illuminate\Support\Str;

class RouteGenerator extends CodeGenerator
{
    public function generate(array $spec): void
    {
        $this->loadStub('Routes');
        $this->setSpec($spec);
        $entityName = $this->required('name');
    
        $slug = Str::slug(Str::plural($entityName));
        
        $this->replace('URL_PREFIX', $slug);
        $this->replace('CONTROLLER', "{$entityName}Controller");
        $this->replace('VAR_NAME', lcfirst($entityName));
    }
    
    public function save(): string
    {
        $routesFile = base_path('routes/api.php');
        
        $contents = file_get_contents($routesFile);
        $contents .= PHP_EOL;
        $contents .= $this->file;
        
        file_put_contents($routesFile, $contents);
    }
}
