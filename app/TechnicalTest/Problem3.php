<?php

namespace App\TechnicalTest;

class Problem3
{
    public $input;

    public function __construct(){
        $this->input = "";
    }

    public function getHigherFormulaValue() {        
        if (strlen($this->input) < 1 || strlen($this->input) > 105) {
            return array("error" => true, "output" => 'La longitud del input de entrada debe ser entre 1 a 105 caracteres. Palabra: '.$this->input);
        }
        $result = $this->repetedWords($this->input);
        $maxValue = 0;
        foreach ($result as $value) {
            if ($value >= $maxValue){
                $maxValue = $value;
            }
        }
        return array("error" => false, "output" => $maxValue);
    }


    private function repetedWords($input) {
        $combinations = array();
        for ($i=0; $i < strlen($input); $i++) { 
            for ($j=0; $j < strlen($input) - $i; $j++) { 
                $char = substr($input, $i, $j + 1);                
                $repeted = $this->searchRepetedWords($char, $input);                
                if ($repeted >= 1) {
                    $f_s = strlen($char) * $repeted;
                    $combinations[$char] = $f_s;
                }   
            }
        }
        return $combinations;
    }

    private function searchRepetedWords($searchChar, $input) {
        $repeted = 0;
        for ($i=0; $i < strlen($input); $i++) { 
            for ($j=0; $j < strlen($input) - $i; $j++) { 
                $char = substr($input, $i, $j + 1);
                if ($searchChar === $char) {
                    $repeted++;
                }
            }
        }
        return $repeted;
    }
}
