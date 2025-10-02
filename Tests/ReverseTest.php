<?php

use PHPUnit\Framework\TestCase;
use App\Services\ReverseTextService;

class ReverseTest extends TestCase {

    private ReverseTextService $reverseService;

    protected function setUp(): void
    {
        $this->reverseService = new ReverseTextService();
    }

    public function testBasicEnglish() {
        $this->assertEquals('Tac', $this->reverseService->reverseWordsInString('Cat'));
        $this->assertEquals('esuOh', $this->reverseService->reverseWordsInString('houSe'));
        $this->assertEquals('tnAhPele', $this->reverseService->reverseWordsInString('elEpHant'));
    }

    public function testRussian() {
        $this->assertEquals('Ьшым', $this->reverseService->reverseWordsInString('Мышь'));
        $this->assertEquals('кимОД', $this->reverseService->reverseWordsInString('домИК'));
    }

    public function testPunctuation() {
        $this->assertEquals('tac,', $this->reverseService->reverseWordsInString('cat,'));
        $this->assertEquals('Амиз:', $this->reverseService->reverseWordsInString('Зима:'));
        $this->assertEquals("si 'dloc' won", $this->reverseService->reverseWordsInString("is 'cold' now"));
        $this->assertEquals('отэ «Кат» "отсорп"', $this->reverseService->reverseWordsInString('это «Так» "просто"'));
    }

    public function testCompound() {
        $this->assertEquals('driht-trap', $this->reverseService->reverseWordsInString('third-part'));
        $this->assertEquals('nac`t', $this->reverseService->reverseWordsInString('can`t'));
    }

    public function testMixed() {
        $this->assertEquals('отэ «Кат» "отсорп\'', $this->reverseService->reverseWordsInString('это «Так» "просто\''));
    }
}