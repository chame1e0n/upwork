<?php

namespace App\Services;

use App\Contracts\Translator;
use Google\Cloud\Translate\V3\TranslationServiceClient;

/**
 * Basic google translator.
 * 
 * @author Vitalii Zinkov
 */
class TranslatorService implements Translator
{
    /**
     * Translation service client.
     * 
     * @var \Google\Cloud\Translate\V3\TranslationServiceClient
     */
    private $translator;

    /**
     * Translation Service Client initialization.
     */
    public function __construct(TranslationServiceClient $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Translate provided string in the specified language.
     * 
     * @param string $text  original string
     * @return array    result of the translation operation
     */
    public function translate(string $text) : array
    {
        try {
            $contents = (array)$text;
            $target_language_code = static::LOCALE;

            $formatted_parent = $this->translator->locationName('upwork-312309', 'global');
            $response = $this->translator->translateText($contents, $target_language_code, $formatted_parent);

            /* @var $response \Google\Cloud\Translate\V3\TranslateTextResponse */

            $translations = $response->getTranslations();
            $translation = $translations[0]->getTranslatedText();

            if ($translation == $text) {
                throw new \Exception('Translation impossible to execute!');
            }

            $result = ['success' => true, 'error' => '', 'translation' => $translation];
        } catch (\Exception $e) {
            $result = ['success' => false, 'error' => $e->getMessage(), 'translation' => ''];
        } finally {
            $this->translator->close();
        }

        return $result;
    }
}
