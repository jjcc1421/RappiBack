<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Matrix;

class MatrixController extends Controller
{

    public function index()
    {
        //return $this->runTest("http://localhost/rappi/public/input0.txt");
        return view('index');

    }


    /**
     * Run a test file
     * @param $filePath - path to file test case
     * @return string - out of run test case
     */
    private function runTest($filePath)
    {
        $output = "";
        $_fp = fopen($filePath, "r");
        $cases = fgets($_fp);
        for ($i = 0; $i < $cases; $i++) {
            $config = fgets($_fp);
            $configArray = explode(" ", $config);
            $N = $configArray[0];
            $queriesCases = $configArray[1];
            $matrix = new Matrix($N);
            for ($j = 0; $j < $queriesCases; $j++) {
                $query = fgets($_fp);
                $queryOutput = $this->runCommand($matrix, $query);
                if (!is_null($queryOutput)) {
                    $output = $output . $queryOutput . "<br/>";
                }
            }
        }
        fclose($_fp);
        return $output;
    }

    /**
     * Executes a specific query into matrix
     * @param Matrix $matrix - matrix to get query
     * @param $query - query to run
     * @return int|null - out of query
     */
    private function runCommand(Matrix $matrix, $query)
    {
        //$query=fgets($this->_fp);
        $queryArray = explode(" ", $query);
        switch ($queryArray[0]) {
            case 'UPDATE':
                $matrix->update($queryArray[1], $queryArray[2], $queryArray[3], $queryArray[4]);
                break;
            case 'QUERY':
                return $matrix->runQuery($queryArray[1], $queryArray[2], $queryArray[3], $queryArray[4], $queryArray[5], $queryArray[6]);
                break;
        }
        return null;
    }
}
