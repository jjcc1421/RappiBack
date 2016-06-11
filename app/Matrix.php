<?php

namespace App;

use Exception;

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
        if ((int)$N < 1 || (int)$N > 100)
            throw new Exception("Matrix size length error");
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
        if (1 > (int)$x1 || (int)$x1 > (int)$x2 || (int)$x2 > (int)$this->N)
            throw new Exception("Out of bounds");
        if (1 > (int)$y1 || (int)$y1 > (int)$y2 || (int)$y2 > (int)$this->N)
            throw new Exception("Out of bounds");
        if (1 > (int)$z1 || (int)$z1 > (int)$z2 || (int)$z2 > (int)$this->N)
            throw new Exception("Out of bounds");

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
        if ($x > $this->N || $x < 1)
            throw new Exception("out of bounds");
        if ($y > $this->N || $y < 1)
            throw new Exception("out of bounds");
        if ($z > $this->N || $z < 1)
            throw new Exception("out of bounds");

        $this->matrix[$x - 1][$y - 1][$z - 1] = $W;
        return $this->matrix[$x - 1][$y - 1][$z - 1];
    }

    public function runCommand($query)
    {
        $queryArray = explode(" ", $query);
        switch ($queryArray[0]) {
            case 'UPDATE':
                $this->update($queryArray[1], $queryArray[2], $queryArray[3], $queryArray[4]);
                break;
            case 'QUERY':
                return $this->runQuery($queryArray[1], $queryArray[2], $queryArray[3], $queryArray[4], $queryArray[5], $queryArray[6]);
                break;
            default;
                throw new Exception("Unsupported query");
                break;
        }
        return null;
    }
}
