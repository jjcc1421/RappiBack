<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Matrix;
use Illuminate\Support\Facades\Input;
use Flash;
use Exception;

class MatrixController extends Controller
{

    public function index()
    {
        return view('index', ['output' => null]);

    }

    public function runExecution()
    {
        $file = Input::file('fileToUpload');
        $output = $this->runTest($file->getPathname());
        return view('index', ['output' => $output]);

    }


    /**
     * Run a test file
     * @param $filePath - path to file test case
     * @return string - out of run test case
     */
    private function runTest($filePath)
    {
        try {
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
                    //$queryOutput = $this->runCommand($matrix, $query);
                    $queryOutput = $matrix->runCommand($query);
                    if (!is_null($queryOutput)) {
                        $output = $output . $queryOutput . "<br/>";
                    }
                }
            }
            fclose($_fp);
            Flash::success('Successful executed!');
        } catch (Exception $e) {
            Flash::Error('Can not execute');
            $output = null;
        }
        return $output;
    }
}
