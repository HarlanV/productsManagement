<?php

namespace Tests\Unit;

use App\Http\Requests\ProductRequest;
use Tests\TestCase;

class ProductRequestTest extends TestCase
{
    public $rules;
    public $validator;

    public function setUp(): void
    {
        parent::setUp();
        $this->rules = (new ProductRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    public function testValidName()
    {
        $this->assertTrue($this->validateField('name', 'jon'));
        $this->assertTrue($this->validateField('name', 'jo'));
        $this->assertTrue($this->validateField('name', 'jon1'));
    }

    public function testInvalidName()
    {
        $this->assertFalse($this->validateField('name', 'j'));
        $this->assertFalse($this->validateField('name', ''));
        $this->assertFalse($this->validateField('name', '1'));
    }

    public function testValidQuantity()
    {
        $this->assertTrue($this->validateField('quantity', 123456789));
        $this->assertTrue($this->validateField('quantity', 01));
        $this->assertTrue($this->validateField('quantity', 1));
        $this->assertTrue($this->validateField('quantity', 0));
        $this->assertTrue($this->validateField('quantity', '123456789'));
        $this->assertTrue($this->validateField('quantity', '1'));
        $this->assertTrue($this->validateField('quantity', '0'));
    }

    public function testInvalidQuantity()
    {
        $this->assertFalse($this->validateField('quantity', null));
        $this->assertFalse($this->validateField('quantity', '01'));
        $this->assertFalse($this->validateField('quantity', 'A'));
        $this->assertFalse($this->validateField('quantity', 'A1'));
        $this->assertFalse($this->validateField('quantity', '1A1'));
    }

    public function testValidPrice()
    {
        $this->assertTrue($this->validateField('price', 123456789));
        $this->assertTrue($this->validateField('price', 01));
        $this->assertTrue($this->validateField('price', 1));
        $this->assertTrue($this->validateField('price', 0));
        $this->assertTrue($this->validateField('price', 123456789.1));
        $this->assertTrue($this->validateField('price', 01.1));
        $this->assertTrue($this->validateField('price', 01.01));
        $this->assertTrue($this->validateField('price', 01.001));
        $this->assertTrue($this->validateField('price', 1.100));
        $this->assertTrue($this->validateField('price', 1.1));
        $this->assertTrue($this->validateField('price', 0.1));
        $this->assertTrue($this->validateField('price', 0.01));
        $this->assertTrue($this->validateField('price', 0.001));
        $this->assertTrue($this->validateField('price', '123456789'));
        $this->assertTrue($this->validateField('price', '1'));
        $this->assertTrue($this->validateField('price', '0'));
        $this->assertTrue($this->validateField('price', '01'));
    }

    public function testInvalidPrice()
    {
        $this->assertFalse($this->validateField('price', null));
        $this->assertFalse($this->validateField('price', 'A'));
        $this->assertFalse($this->validateField('price', 'A1'));
        $this->assertFalse($this->validateField('price', '1A1'));
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
