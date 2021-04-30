<?php

namespace App\Http\Controllers;

use App\Contracts\Translator;
use Illuminate\Http\Request;

class RussianTranslatorController extends Controller
{
    /**
     * Translator into russian.
     * 
     * @var \App\Services\RussianTranslatorService
     */
    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function index(Request $request)
    {
        return $this->translator->translate($request->text);
    }
}
