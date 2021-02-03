<?php

namespace Tests\Unit;

use App\Http\Requests\CategoryRequest;
use Tests\TestCase;

class CategoryRequestTest extends TestCase
{
    public $rules;
    public $validator;

    public function setUp(): void
    {
        parent::setUp();
        $this->rules = (new CategoryRequest())->rules();
        $this->validator = $this->app['validator'];
    }
    
    /** @test */
    public function testValidName()
    {
        $this->assertTrue($this->validateField('name', 'jon'));
        $this->assertTrue($this->validateField('name', 'jo'));
        $this->assertTrue($this->validateField('name', 'jon1'));
    }
    
    /** @test */
    public function testInvalidName()
    {
        $this->assertFalse($this->validateField('name', 'j'));
        $this->assertFalse($this->validateField('name', ''));
        $this->assertFalse($this->validateField('name', null));
        $this->assertFalse($this->validateField('name', '1'));
    }

    protected function getFieldValidator($field, $value)
    {
        return $this->validator->make(
            [$field => $value], 
            [$field => $this->rules[$field]]
        );
    }
    
    protected function validateField($field, $value)
    {
        return $this->getFieldValidator($field, $value)->passes();
    }


}