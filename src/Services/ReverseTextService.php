<?php

namespace App\Services;

class ReverseTextService
{
    public function reverseWordsInString(string $str): string
    {
        $result = '';
        $length = mb_strlen($str, 'UTF-8');
        $i = 0;

        while ($i < $length) {
            $char = mb_substr($str, $i, 1, 'UTF-8');

            if (preg_match('/\p{L}/u', $char)) {
                $letters = [];
                $cases = [];

                while ($i < $length && preg_match('/\p{L}/u', $char = mb_substr($str, $i, 1, 'UTF-8'))) {
                    $letters[] = $char;
                    $upper = mb_strtoupper($char, 'UTF-8');
                    $lower = mb_strtolower($char, 'UTF-8');
                    $cases[] = ($char === $upper && $upper !== $lower);
                    $i++;
                }

                $reversedLetters = array_reverse($letters);

                for ($j = 0; $j < count($reversedLetters); $j++) {
                    if ($cases[$j]) {
                        $reversedLetters[$j] = mb_strtoupper($reversedLetters[$j], 'UTF-8');
                    } else {
                        $reversedLetters[$j] = mb_strtolower($reversedLetters[$j], 'UTF-8');
                    }
                }

                $result .= implode('', $reversedLetters);
            } else {
                $result .= $char;
                $i++;
            }
        }

        return $result;
    }
}