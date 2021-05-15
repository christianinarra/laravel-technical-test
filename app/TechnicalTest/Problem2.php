<?php

namespace App\TechnicalTest;

class Problem2
{
    public $input;

    public function __construct(){}

    public function chessboard() {        
        $arr = explode( PHP_EOL , $this->input);
        $i = 0;
        foreach($arr as $row) {
            if ($i == 0) {
                $strLine = explode(" ", trim($row));
                $boardDimension = $strLine[0];
                $numObstacles = $strLine[1];
            }
            if ($i == 1) {
                $strLine = explode(" ", trim($row));
                $rq = $strLine[0];
                $cq = $strLine[1];
            }
            if ($i > 1) {
                $strLine = explode(" ", trim($row));
                $obstaclesPosx[] = $strLine[0];
                $obstaclesPosy[] = $strLine[1];
            }
            $i++;
        }        
        if ($boardDimension < 1 || $boardDimension > 100000 || $numObstacles < 1 || $numObstacles > 100000) {
            return array("error" => true, "output" => 'La dimencion del tablero debe ser mayor a 0 y menor a 10 elevado a 5');
        }
        for ($i = 0; $i < $numObstacles; $i++){
            if ($obstaclesPosx[$i] == $rq && $obstaclesPosy[$i] == $cq){
                return array("error" => true, "output" => 'Un obstaculo no puede estar en la posicion de la reina');
            }
        }
        return array("error" => false, "output" => $this->queensAttack($boardDimension, 
                    $numObstacles,
                    $rq,
                    $cq,
                    $obstaclesPosx, 
                    $obstaclesPosy));
    }

    public function queensAttack($n, $k, $rq, $cq, $obstaclesPosx, $obstaclesPosy) {
        $diagonalAttacks = $this->diagonalAttacks($n, $k, $rq, $cq, $obstaclesPosx, $obstaclesPosy);
        $horizontalAndVerticalAttacks = $this->horizontalAndVerticalAttacks($n, $k, $rq, $cq, $obstaclesPosx, $obstaclesPosy);
        return $diagonalAttacks + $horizontalAndVerticalAttacks;
    }
    
    private function diagonalAttacks($n, $k, $rq, $cq, $obstaclesPosx, $obstaclesPosy) {
        $dirDownLeft = min( $rq-1, $cq-1 ); // Distance Down Left
        $dirUpRight = min( $n-$rq, $n-$cq ); // Distance Up Right
        $dirUpLeft = min( $n-$rq, $cq-1 ); // Distance Up Left
        $dirDownRight = min( $rq-1, $n-$cq ); // Distance Down Right

        for ($i = 0; $i < $k; $i++){
            // 4 Diagonals
            if ( $rq > $obstaclesPosx[$i] && $cq > $obstaclesPosy[$i] && $rq-$obstaclesPosx[$i] == $cq-$obstaclesPosy[$i] )
                $dirDownLeft = min($dirDownLeft, $rq-$obstaclesPosx[$i]-1);
    
            if ( $obstaclesPosx[$i] > $rq && $obstaclesPosy[$i] > $cq && $obstaclesPosx[$i]-$rq == $obstaclesPosy[$i]-$cq )
                $dirUpRight = min($dirUpRight, $obstaclesPosx[$i]-$rq-1);
    
            if ( $obstaclesPosx[$i] > $rq && $cq > $obstaclesPosy[$i] && $obstaclesPosx[$i]-$rq == $cq-$obstaclesPosy[$i] )
                $dirUpLeft = min($dirUpLeft, $obstaclesPosx[$i]-$rq-1);
    
            if ( $rq > $obstaclesPosx[$i] && $obstaclesPosy[$i] > $cq && $rq-$obstaclesPosx[$i] == $obstaclesPosy[$i]-$cq )
                $dirDownRight = min($dirDownRight, $rq-$obstaclesPosx[$i]-1);    
        }        
        return $dirDownLeft + $dirUpRight + $dirUpLeft + $dirDownRight;
    }

    public function horizontalAndVerticalAttacks($n, $k, $rq, $cq, $obstaclesPosx, $obstaclesPosy) {
        $rowLeft = $cq-1; // Left
        $rowRight = $n-$cq; // Right
        $colDown = $rq-1; // Down
        $colUp = $n-$rq; // Up
        
        for ($i = 0; $i < $k; $i++){            
            // Horizontal and Vertical
            if ( $rq == $obstaclesPosx[$i] && $obstaclesPosy[$i] < $cq )
                $rowLeft = min($rowLeft, $cq-$obstaclesPosy[$i]-1);
    
            if ( $rq == $obstaclesPosx[$i] && $obstaclesPosy[$i] > $cq )
                $rowRight = min($rowRight, $obstaclesPosy[$i]-$cq-1);
    
            if ( $cq == $obstaclesPosy[$i] && $obstaclesPosx[$i] < $rq )
                $colDown = min($colDown, $rq-$obstaclesPosx[$i]-1);
    
            if ( $cq == $obstaclesPosy[$i] && $obstaclesPosx[$i] > $rq )
                $colUp = min($colUp, $obstaclesPosx[$i]-$rq-1);
        }        
        return $rowLeft + $rowRight + $colDown + $colUp;
    }
}
