<?php

namespace App;

class Matrix
{
    private $N=1;
    private $matrix=array(array(array()));

    /**
     * Matrix constructor.
     * @param array $matrix
     * @param int $N
     */
    public function __construct($N)
    {
        $this->N = $N;
    }

    public function runQuery($x1,$y1,$z1,$x2,$y2,$z2){
        $acum=0;
        for ($x = $x1-1; $x < $x2; $x++) {
            for ($y = $y1-1; $y < $y2; $y++) {
                for ($z = $z1-1; $z < $z2; $z++) {
                    $acum=$acum+($this->matrix[$x][$y][$z]);
                }
            }
        }
        return $acum;
    }

    public function update($x,$y,$z,$W){
        $this->matrix[$x-1][$y-1][$z-1]=$W;
        return $this->matrix[$x-1][$y-1][$z-1];
    }
}
