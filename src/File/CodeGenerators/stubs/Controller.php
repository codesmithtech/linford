<?php
namespace DummyNamespace;

use CodeSmithTech\Genesis\Http\Controllers\ApiController;
/** @placeholder IMPORTS */

class DummyController extends ApiController
{
    public function search()
    {
        return $this->ok(ENTITY_NAME::query()->get());
    }
    
    public function view(ENTITY_NAME $VAR_NAME)
    {
        return $this->ok($VAR_NAME);
    }
    
    public function create(REQUEST_CLASS $request)
    {
        $VAR_NAME = new ENTITY_NAME($request->validated());
        $VAR_NAME->save();
        
        return $this->ok($VAR_NAME);
    }
    
    public function update(ENTITY_NAME $VAR_NAME, REQUEST_CLASS $request)
    {
        $VAR_NAME->fill($request->validated());
        $VAR_NAME->save();
        return $this->ok($VAR_NAME);
    }
    
    public function remove(ENTITY_NAME $VAR_NAME)
    {
        $VAR_NAME->delete();
        return $this->ok(['deleted' => true]);
    }
}