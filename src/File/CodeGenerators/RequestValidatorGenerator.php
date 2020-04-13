<?php
namespace CodeSmithTech\Linford\File\CodeGenerators;

class RequestValidatorGenerator extends CodeGenerator
{
    public function generate(array $spec): void
    {
        $this->loadStub('RequestValidator');
        $this->setSpec($spec);
        $entityName = $this->required('name');
        
        $this->replaceNamespace("Http\\Controllers\\Api\\Requests\\$entityName");
        $this->replace('DummyRequest', 'Store' . $entityName);
        
        $lines = [];
        
        foreach ($this->required('properties') as $config) {
            if (! $config['validators']) {
                continue;
            }
            
            $lines[] = str_repeat(' ', 12) . "'{$config['name']}' => '" . $this->implodeValidationRules($config['validators']) . "',";
        }
        
        $this->replacePlaceholderWithLines('RULES', $lines);
    }
    
    private function implodeValidationRules(array $validators)
    {
        $rules = [];
        
        if (($idx = array_search('required', $validators)) !== false) {
            $rules[] = 'required';
            unset($validators[$idx]);
        }
    
        if (($idx = array_search('sometimes', $validators)) !== false) {
            $rules[] = 'sometimes';
            unset($validators[$idx]);
        }
    
        if (($idx = array_search('nullable', $validators)) !== false) {
            $rules[] = 'nullable';
            unset($validators[$idx]);
        }
        
        $rules = array_merge($rules, $validators);
        return implode('|', $rules);
    }
    
    public function save(): string
    {
        $entityName = $this->required('name');
        $requestClassName = "Store$entityName";
        $dirPath = app_path('Http/Controllers/Api/Requests/' . $entityName);
    
        if (! is_dir($dirPath)) {
            mkdir($dirPath);
        }
        
        $filePath = $dirPath . '/' . $requestClassName . '.php';
        
        file_put_contents($filePath, $this->file);
        
        return $filePath;
    }
}
