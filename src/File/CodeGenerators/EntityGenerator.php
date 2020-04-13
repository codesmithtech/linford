<?php
namespace CodeSmithTech\Linford\File\CodeGenerators;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class EntityGenerator extends CodeGenerator
{
    public function generate(array $spec): void
    {
        $this->setSpec($spec);
        
        $this->loadStub('Entity');
        
        $this->replaceNamespace('Entity');
        $this->replaceTableName();
        $this->replaceEntityName();
        $this->replaceProps();
        $this->replaceTraits();
        $this->replaceRelations();
        $this->replaceCasts();
        $this->postProcess();
    }
    
    public function save(): string
    {
        $dirPath = app_path('Entity/');
        if (! is_dir($dirPath)) {
            mkdir($dirPath);
        }
        
        $filePath = $dirPath . $this->required('name') . '.php';
        
        file_put_contents($filePath, $this->file);
        return $filePath;
    }
    
    protected function replaceTableName()
    {
        $this->replace('DummyTable', Str::camel($this->required('name')));
    }
    
    protected function replaceEntityName()
    {
        $this->replace('DummyEntity', $this->required('name'));
    }
    
    protected function replaceProps()
    {
        foreach ($this->required('properties') as $propConfig) {
            $this->addProp($propConfig['name'], $propConfig['type']);
        }
    }
    
    protected function replaceTraits()
    {
        if (! $traits = $this->option('traits')) {
            return;
        }
        
        if (! in_array('SoftDeletes', $traits)) {
            return;
        }
        
        $this->addTrait(SoftDeletes::class);
    }
    
    protected function replaceRelations()
    {
        $compiledRelations = [];
    
        foreach ($this->option('relationships') as $relationshipConfig) {
            $relatedEntityName = $relationshipConfig['relatedEntity'];
            $methodName = Str::camel($relatedEntityName);
            $relationshipMethod = Str::camel($relationshipConfig['relationshipType']);
            $relationshipTypeClass = $relationshipConfig['relationshipType'];
            $foreignKeyColumn = $relationshipConfig['foreignKey'];
            $this->addImport("Illuminate\Database\Eloquent\Relations\\${relationshipConfig['relationshipType']}");
    
            switch ($relationshipConfig['relationshipType']) {
                case 'BelongsTo':
                    $this->addProp($foreignKeyColumn, 'integer');
                    $this->addProp($methodName, $relatedEntityName);
                    break;
                case 'HasMany':
                    $this->addImport(Collection::class);
                    $methodName .= 's';
                    $this->addProp($methodName, $relatedEntityName . '[]|Collection');
                    break;
                default:
                    throw new \Exception("Cannot handled relationship type of ${relationshipMethod}");
            }
            
            $compiledRelations[] = "
    public function $methodName(): $relationshipTypeClass
    {
        return \$this->$relationshipMethod($relatedEntityName::class, '$foreignKeyColumn');
    }";
        }
        
        $this->replacePlaceholderWithLines('RELATIONS', $compiledRelations);
    }
    
    protected function replaceCasts()
    {
        $casts = [];
        
        foreach ($this->required('properties') as $propName => $propConfig) {
            if (in_array($propConfig['type'], ['array'])) {
                $casts[$propName] = $propConfig['type'];
            }
        }
        
        if (! $casts) {
            $this->removePlaceholder('CASTS');
            return;
        }
        
        $compiled = "protected \$casts = [" . PHP_EOL;
        
        foreach ($casts as $propName => $castType) {
            $compiled .= "        '$propName' => '$castType'," . PHP_EOL;
        }
        
        $compiled .= '    ];';
    
        $this->replacePlaceholder("CASTS", $compiled);
    }
}