<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TranslationTest extends TestCase
{
    /**
     * Checking positive translation.
     *
     * @return void
     */
    public function testPositiveAPITranslation()
    {
        $response = $this->get('/api/translate/to/russian?text=Hello world!');

        $response->assertOk();
        $response->assertExactJson(['success' => true, 'error' => '', 'translation' => 'Привет мир!']);
    }

    /**
     * Checking negative translation.
     *
     * @return void
     */
    public function testNegativeAPITranslation()
    {
        $response = $this->get('/api/translate/to/russian?text=__');

        $response->assertOk();
        $response->assertExactJson(['success' => false, 'error' => 'Translation impossible to execute!', 'translation' => '']);
    }
}
