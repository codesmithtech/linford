<?php
namespace CodeSmithTech\Linford\Http\Controllers;

use CodeSmithTech\Linford\File\CodeGenerator;
use CodeSmithTech\Linford\File\EntityFinder;
use CodeSmithTech\Linford\Http\Requests\CreateApiEntity;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    public function listEntities()
    {
        $entityFinder = new EntityFinder();
        $entities = $entityFinder->findEntitiesInDirectory(config('linford.entityDir', app_path('Entity')));
        
        return $this->ok($entities);
    }
    
    public function create(CreateApiEntity $request, CodeGenerator $generator)
    {
        $generator->createApiResource($request->validated());
        return $this->ok($request->validated());
    }
    
    private function ok($data)
    {
        return response()->json($data);
    }
}