<?php

use PHPUnit\Framework\TestCase;

class ReverseTest extends TestCase {
    public function testBasicEnglish() {
        $this->assertEquals('Tac', reverseWordsInString('Cat'));
        $this->assertEquals('esuOh', reverseWordsInString('houSe'));
        $this->assertEquals('tnAhPele', reverseWordsInString('elEpHant'));
    }

    public function testRussian() {
        $this->assertEquals('Ьшым', reverseWordsInString('Мышь'));
        $this->assertEquals('кимОД', reverseWordsInString('домИК'));
    }

    public function testPunctuation() {
        $this->assertEquals('tac,', reverseWordsInString('cat,'));
        $this->assertEquals('Амиз:', reverseWordsInString('Зима:'));
        $this->assertEquals("si 'dloc' won", reverseWordsInString("is 'cold' now"));
        $this->assertEquals('отэ «Кат» "отсорп"', reverseWordsInString('это «Так» "просто"'));
    }

    public function testCompound() {
        $this->assertEquals('driht-trap', reverseWordsInString('third-part'));
        $this->assertEquals('nac`t', reverseWordsInString('can`t'));
    }

    public function testMixed() {
        $this->assertEquals('отэ «Кат» "отсорп\'', reverseWordsInString('это «Так» "просто\''));
    }
}