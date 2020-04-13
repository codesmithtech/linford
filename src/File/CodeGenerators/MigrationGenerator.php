<?php
namespace CodeSmithTech\Linford\File\CodeGenerators;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class MigrationGenerator extends CodeGenerator
{
    private $fileName;
    
    public function generate(array $spec): void
    {
        $this->setSpec($spec);
        
        // create a migration file
        $table = Str::camel($this->required('name'));
        $name = "linford_create_{$table}_table";
        Artisan::call("gen:make:migration $name --create $table");
        $output = trim(Artisan::output());
        
        // extract the migration filename from the output
        $this->fileName = base_path('database/migrations/' . str_replace('Created Migration: ', '', $output) . '.php');
        $this->loadStub($this->fileName);
        $lines = [];
        
        foreach ($this->option('relationships') as $config) {
            if ($config['relationshipType'] !== 'BelongsTo') {
                continue;
            }
            
            $lines[] = $this->generateMigrationStatement($config['foreignKey'], ['type' => 'unsignedInteger']);
        }
        
        foreach ($this->required('properties') as $config) {
            $lines[] = $this->generateMigrationStatement($config['name'], $config);
        }
    
        foreach ($this->option('relationships') as $config) {
            if ($config['relationshipType'] !== 'BelongsTo') {
                continue;
            }
        
            $lines[] = $this->generateForeignKeyStatement($config['foreignKey'], strtolower($config['relatedEntity']));
        }
        
        if (($traits = $this->option('traits')) && (in_array('softDeletes', $traits))) {
            $lines[] = str_repeat(' ', 12) . '$this->softDeletes($table);';
        }
        
        $lines[0] = trim($lines[0]);
        $this->replace('// migration', implode(PHP_EOL, $lines));
    }
    
    private function generateMigrationStatement(string $fieldName, $config)
    {
        $stmt = '$table->';
        
        switch ($config['type']) {
            case 'string':
                $size = $config['size'] ?? 255;
                $stmt .= "string('$fieldName', $size)";
                break;
            case 'array':
                $stmt .= "json('$fieldName')";
                break;
            case 'unsignedInteger':
            case 'signedInteger':
            case 'timestamp':
            case 'text':
            case 'dateTime':
            case 'date':
                $stmt .= "{$config['type']}('$fieldName')";
                break;
            default:
                throw new \InvalidArgumentException("Cannot handle field type of {$config['type']}");
        }
        
        if ($config['nullable'] ?? false) {
            $stmt .= '->nullable()';
        }
        
        if ($config['defaultValue'] ?? false) {
            if ($config['type'] === 'string') {
                $defaultVal = "'{$config['defaultValue']}'";
            } else {
                $defaultVal = $config['defaultValue'];
            }
            
            $stmt .= "->default($defaultVal)";
        }
        
        return str_repeat(' ', 12) . $stmt . ';';
    }
    
    private function generateForeignKeyStatement(string $foreignKeyColName, string $foreignTableName)
    {
        $foreignTableName = lcfirst($foreignTableName);
        $stmt = "\$table->foreign('$foreignKeyColName')->references('id')->on('$foreignTableName')";
        return str_repeat(' ', 12) . $stmt . ';';
    }
    
    public function save(): string
    {
        file_put_contents($this->fileName, $this->file);
        return $this->fileName;
    }
}
