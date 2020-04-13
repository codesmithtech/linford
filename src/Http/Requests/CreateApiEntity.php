<?php
namespace CodeSmithTech\Linford\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateApiEntity extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'name' => 'required|string',
            
            'properties' => 'required|array',
            'properties.*.name' => 'required|string',
            'properties.*.type' => 'required|string',
            'properties.*.length' => 'sometimes|nullable|int',
            'properties.*.nullable' => 'sometimes|nullable|boolean',
            'properties.*.defaultValue' => 'sometimes|nullable',
            'properties.*.validators' => 'array',
            'properties.*.validators.*' => 'string',
            
            'relationships' => 'sometimes|array',
            'relationships.*.relatedEntity' => 'required|string',
            'relationships.*.relationshipType' => 'required|string',
            'relationships.*.foreignKey' => 'required|string',
            
            'traits' => 'sometimes|array',
            'traits.*' => 'string',
            
            'dbIndexes' => 'sometimes|array',
            'dbIndexes.*.indexType' => 'string|in:Unique,Index',
            'dbIndexes.*.columns' => 'array',
            'dbIndexes.*.columns.*' => 'string',
            'dbIndexes.*.name' => 'string',
            
            'shouldCreatePolicy' => 'sometimes|nullable|boolean',
        ];
    }
}