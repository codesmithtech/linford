<?php
namespace CodeSmithTech\Linford\File;

class EntityFinder
{
    public function findEntitiesInDirectory(string $directoryPath)
    {
        $entities = [];
        
        $dir = new \RecursiveDirectoryIterator($directoryPath, \FilesystemIterator::SKIP_DOTS);
        $iterator = new \RecursiveIteratorIterator($dir);
        
        /** @var \SplFileInfo $fileInfo */
        foreach ($iterator as $fileInfo) {
            
            $fileContent = file_get_contents($fileInfo->getRealPath());
            if (! strpos($fileContent, 'extends EntityModel')) {
                continue;
            }
            
            // we got this far, so we have an entity
            $entityName = $fileInfo->getBasename('.php');
            $className  = $this->extractNamespace($fileInfo->getRealPath()) . '\\' . $entityName;
            
            $entities[] = compact('entityName', 'className');
        }
        
        // sort alphabetically
        usort($entities, function($a, $b) {
            if ($a['entityName'] > $b['entityName']) {
                return 1;
            }
            
            return $a['entityName'] === $b['entityName'] ? 0 : -1;
        });
        
        return $entities;
    }

    private function extractNamespace(string $filePath)
    {
        foreach (file($filePath) as $line) {
            $line = trim($line);
            if (preg_match('/^namespace/', $line)) {
                return str_replace(['namespace ', ';'], '', $line);
            }
        }
        
        throw new \LogicException("Could not detect a namespace in $filePath");
    }
}