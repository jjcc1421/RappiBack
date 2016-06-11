<?php

namespace App;


class CasesManager {
    private $testCases=0;
    private $queriesCases=0;
    private $N=1;
    private $matrix=array(array(array()));
    private $_fp;

    /*public function runTest(){
        for ($i=0; $i < $this->testCases; $i++) {
            $config=fgets($this->_fp);
            $configArray=explode(" ",$config);
            $this->N=$configArray[0];
            for ($x = 0; $x < $this->N; $x++) {
                for ($y = 0; $y < $this->N; $y++) {
                    for ($z = 0; $z < $this->N; $z++) {
                        $this->matrix[$x][$y][$z]=0;
                    }
                }
            }
            $this->queriesCases=$configArray[1];
            for ($j=0; $j < $this->queriesCases; $j++) {
                $this->runCommand();
            }
        }
    }*/

    public function runCommand(){
        $query=fgets($this->_fp);
        $queryArray=explode(" ",$query);
        switch ($queryArray[0]) {
            case 'UPDATE':
                $this->update($queryArray[1],$queryArray[2],$queryArray[3],$queryArray[4]);
                break;

            case 'QUERY':
                $this->runQuery($queryArray[1],$queryArray[2],$queryArray[3],$queryArray[4],$queryArray[5],$queryArray[6]);
                break;
            default:
                break;
        }
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

        echo $acum."\n";
        return $acum;
    }

    public function update($x,$y,$z,$W){
        $this->matrix[$x-1][$y-1][$z-1]=$W;
    }

    /*public function runFile($filePath){
        $this->_fp = fopen($filePath, "r");
        $this->testCases=fgets($this->_fp);
        $this->runTest();
        fclose($this->_fp);
    }*/

}
