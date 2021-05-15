<?php

namespace App\TechnicalTest;

class Problem1
{
    public $input;

    public function __construct(){
        $this->input = "";
    }

    public function findWinningTeam() {
        $arr = explode( PHP_EOL , $this->input);
        $result = array();
        $initSw = true;
        $category = "";
        if (empty($this->input)) {
            return array("error" => true, "output" => 'El input de entrada no puede ser vacio');            
        }        
        foreach($arr as $row) {            
            $strRow = trim($row);            
            if($initSw) {
                $initSw = false;
                $category = $strRow;
                if (strlen($category) > 16) {
                    return array("error" => true, "output" => 'El nombre de la categoria|equipo no debe ser mayor a 16 caracteres. Palabra: '.$category);            
                }
            } else {                
                if($strRow == "FIN") {
                    $initSw = true;
                } else {                    
                    $array = explode(" ", $strRow);
                    $team1 = $array[0];
                    $result1 = $array[1];
                    $team2 = $array[2];
                    $result2 = $array[3];
                    if (strlen($team1) > 16 || strlen($team2) > 16) {
                        return array("error" => true, "output" => 'El nombre de la categoria|equipo no debe ser mayor a 16 caracteres.');            
                    }
                    $teams = $this->winningTeamPerSets($team1, $result1, $team2, $result2);
                    $result = $this->setResultsByTeam($teams, $category, $result);
                }
            }            
            
        }        
        $output = $this->winningTeamPerCategory($result);
        return array("error" => false, "output" => $output);
    }

    private function setResultsByTeam($teams, $category, $result) {
        foreach($teams as $key=>$point) {
            $result[$category][$key] = isset($result[$category][$key]) ? $result[$category][$key] + $point : $point;
        }
        return $result;
    }

    private function winningTeamPerSets($team1, $result1, $team2, $result2) {        
        $output = array();

        if ($result1 > $result2) {
            $output[$team1] = 2;
            $output[$team2] = 1;
        } else {
            $output[$team2] = 2;
            $output[$team1] = 1;
        }
        return $output;
    }

    private function winningTeamPerCategory($results) {
        $output = array();
        foreach ($results as $category => $teams) {            
            $winningTeam = "";
            $teamPoints = 0;
            $tiedTeams = 0;
            foreach ($teams as $key => $value) {
                if ($value >= $teamPoints) {
                    $tiedTeams = $value == $teamPoints ? $tiedTeams + 1 : $tiedTeams;
                    $teamPoints = $value;
                    $winningTeam = $key;
                    $output[$category][$winningTeam] = $teamPoints;
                }
            }
            if ($tiedTeams > 0) {
                $output[$category]["EMPATE"] = $tiedTeams;       
            }
        }
        return $output;
    }
}
