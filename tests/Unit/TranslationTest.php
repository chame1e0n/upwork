<?php

namespace Tests\Unit;

use App\Http\Controllers\RussianTranslatorController;
use App\Contracts\Translator;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class TranslationTest extends TestCase
{
    /**
     * A contoller and service test.
     *
     * @return void
     */
    public function test_controller_and_service()
    {
        $request = Request::create('/api/translate/to/russian?text=one two', 'GET');

        $mock = \Mockery::mock(Translator::class);
        $mock->shouldReceive('translate')
             ->with('one two')
             ->once()
             ->andReturn(['success' => true, 'error' => '', 'translation' => 'один два']);

        $controller = new RussianTranslatorController($mock);
        $response = $controller->index($request);

        $this->assertEquals(['success' => true, 'error' => '', 'translation' => 'один два'], $response, 'Response is not correct!');
    }
}
