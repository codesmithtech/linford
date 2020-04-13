<?php
namespace CodeSmithTech\Linford\File\CodeGenerators;

use Illuminate\Container\Container;

class ControllerGenerator extends CodeGenerator
{
    public function generate(array $spec): void
    {
        $this->loadStub('Controller');
        $this->setSpec($spec);
        $entityName = $this->required('name');
        
        $this->replaceNamespace("Http\\Controllers\\Api");
        $this->replace('DummyController', "{$entityName}Controller");
        $this->replace('ENTITY_NAME', $entityName);
        $this->replace('VAR_NAME', lcfirst($entityName));
        $this->replace('REQUEST_CLASS', "Store$entityName");
        
        $appNs = Container::getInstance()->getNamespace();
        
        $this->addImport("{$appNs}Http\\Controllers\\Api\\Requests\\$entityName\\Store$entityName");
        $this->addImport("{$appNs}Entity\\$entityName");
        
        $this->postProcess();
    }
    
    public function save(): string
    {
        $entityName = $this->required('name');
        $controllerClassName = "{$entityName}Controller";
        $dirPath = app_path('Http/Controllers/Api');
        
        if (! is_dir($dirPath)) {
            mkdir($dirPath);
        }
        
        $filePath = $dirPath . '/' . $controllerClassName . '.php';
        
        file_put_contents($filePath, $this->file);
        
        return $filePath;
    }
}
