<?php

namespace App;

class Matrix
{
    private $N = 1;
    private $matrix;

    /**
     * Matrix constructor.
     * @param array $matrix
     * @param int $N
     */
    public function __construct($N)
    {
        $this->N = $N;
        $matrix = array(array(array()));
    }

    /**
     * Calculates the sum of the value of blocks whose x coordinate is between x1 and x2 (inclusive),
     * y coordinate between y1 and y2 (inclusive) and z coordinate between z1 and z2 (inclusive).
     * @param $x1
     * @param $y1
     * @param $z1
     * @param $x2
     * @param $y2
     * @param $z2
     * @return int
     */
    public function runQuery($x1, $y1, $z1, $x2, $y2, $z2)
    {
        $acum = 0;
        for ($x = $x1 - 1; $x < $x2; $x++) {
            for ($y = $y1 - 1; $y < $y2; $y++) {
                for ($z = $z1 - 1; $z < $z2; $z++) {
                    $acum = $acum + (isset ($this->matrix[$x][$y][$z]) ? $this->matrix[$x][$y][$z] : 0);
                }
            }
        }
        return $acum;
    }

    /**
     * Updates the value of block (x,y,z) to W.
     * @param $x
     * @param $y
     * @param $z
     * @param $W
     * @return mixed
     */
    public function update($x, $y, $z, $W)
    {
        $this->matrix[$x - 1][$y - 1][$z - 1] = $W;
        return $this->matrix[$x - 1][$y - 1][$z - 1];
    }
}
