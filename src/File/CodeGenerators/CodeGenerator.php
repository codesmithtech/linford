<?php
namespace CodeSmithTech\Linford\File\CodeGenerators;

use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository as LaravelConfigRepository;

abstract class CodeGenerator
{
    
    /**
     * @var string
     */
    protected $file = "";
    
    /**
     * @var array
     */
    protected $spec = [];
    
    /**
     * @var array
     */
    protected $imports = [];
    
    /** @var array */
    protected $traits = [];
    
    /**
     * @var array
     */
    protected $props = [];
    
    /**
     * @var LaravelConfigRepository
     */
    protected $laravelConfig;
    
    /**
     * @var int
     */
    protected $indentSize = 0;
    
    public function __construct(LaravelConfigRepository $laravelConfig)
    {
        $this->laravelConfig = $laravelConfig;
    }
    
    protected function setSpec(array $spec)
    {
        $this->spec = $spec;
    }
    
    protected function option($key, $default = null)
    {
        return $this->spec[$key] ?? $default;
    }
    
    protected function required($key)
    {
        if (! array_key_exists($key, $this->spec) || $this->spec[$key] === null || $this->spec[$key] === '') {
            $encodedSpec = PHP_EOL . json_encode($this->spec, JSON_PRETTY_PRINT);
            throw new \InvalidArgumentException("$key is required but not present in the spec: $encodedSpec");
        }
        
        return $this->spec[$key];
    }
    
    protected function addImport(string $className): void
    {
        $this->imports[] = "use $className;";
    }
    
    protected function addTrait(string $className): void
    {
        $parts = explode('\\', $className);
        $baseName = end($parts);
        $this->traits[] = "use $baseName;";
        $this->addImport($className);
    }
    
    protected function addProp(string $propName, string $propType): void
    {
        if (in_array($propType, ['date', 'dateTime', 'timestamp'])) {
            $propType = 'string';
        }
        
        if ($propType === 'json') {
            $propType = 'array';
        }
        
        $this->props[] = " * @property $propType \$$propName";
    }
    
    protected function postProcess(): void
    {
        if ($this->traits) {
            $this->replacePlaceholderWithLines("TRAITS", array_unique($this->traits));
        } else {
            $this->removePlaceholder("TRAITS");
        }
        
        if ($this->imports) {
            $this->replacePlaceholderWithLines("IMPORTS", array_unique($this->imports));
        } else {
            $this->removePlaceholder("IMPORTS");
        }
        
        if ($this->props) {
            array_unshift($this->props,"/**");
            array_push($this->props, " */");
            $this->replacePlaceholderWithLines("PROPS", $this->props);
        } else {
            $this->removePlaceholder("PROPS");
        }
    }
    
    protected function getStubPath(string $name): string
    {
        return __DIR__ . "/stubs/$name.php";
    }
    
    protected function loadStub(string $name): string
    {
        $path = substr($name, 0, 1) === '/' ? $name : $this->getStubPath($name);
        
        if (! file_exists($path)) {
            throw new \Exception("Could not load stub for '$name'. File not found at $path");
        }
        
        $this->file = file_get_contents($path);
        
        return $this->file;
    }
    
    protected function replacePlaceholder(string $placeholderName, string $content): void
    {
        $this->replace("/** @placeholder $placeholderName */", $content);
    }
    
    protected function replacePlaceholderWithDocBlock(string $placeHolderName, string $tag, string $content): void
    {
        $this->replace("/** @placeholder $placeHolderName */", "/** @$tag $content */");
    }
    
    protected function replacePlaceholderWithLines(string $placeholderName, array $lines)
    {
        $this->replace("/** @placeholder $placeholderName */", implode(PHP_EOL, $lines));
    }
    
    protected function replaceNamespace(string $namespaceSuffix)
    {
        $this->replace('DummyNamespace', Container::getInstance()->getNamespace() . $namespaceSuffix);
    }
    
    protected function removePlaceholder(string $placeholderName): void
    {
        $this->replace("/** @placeholder $placeholderName */" . PHP_EOL, "");
    }
    
    protected function replace(string $search, string $replace): void
    {
        $this->file = str_replace($search, $replace, $this->file);
    }
    
    protected function pregReplace(string $search, string $replace): void
    {
        $this->file = preg_replace($search, $replace, $this->file);
    }
    
    protected function indent(string $string): string
    {
        return str_repeat(' ', $this->indentSize) . $string;
    }
    
    abstract public function generate(array $spec): void;
    
    abstract public function save(): string;
}