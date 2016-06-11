<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MatrixTest extends TestCase
{
    public function testNoDataMatrix()
    {
        $matrix = new \App\Matrix(4);
        $this->assertTrue($matrix->runQuery(1, 1, 1, 1, 1, 1) == 0);
    }

    public function testDataMatrix()
    {
        $matrix = new \App\Matrix(4);
        $matrix->update(2, 2, 2, 4);
        $this->assertTrue($matrix->runQuery(1, 1, 1, 3, 3, 3) == 4);
        $matrix->update(1, 1, 1, 23);
        $this->assertTrue($matrix->runQuery(2, 2, 2, 4, 4, 4) == 4);
        $this->assertTrue($matrix->runQuery(1, 1, 1, 3, 3, 3) == 27);
    }

    public function testLowSizeMatrix()
    {
        $this->setExpectedException(\Exception::class);
        $matrix = new \App\Matrix(0);
    }

    public function testBigSizeMatrix()
    {
        $this->setExpectedException(\Exception::class);
        $matrix = new \App\Matrix(1000);
    }

    public function testOutOfBoundsMatrix()
    {
        $this->setExpectedException(\Exception::class);
        $matrix = new \App\Matrix(4);
        $matrix->update(9, 9, 2, 4);
    }

    public function testRunCommandsMatrix()
    {
        $matrix = new \App\Matrix(4);
        $matrix->runCommand("UPDATE 2 2 2 4");
        $this->assertTrue($matrix->runCommand("QUERY 1 1 1 3 3 3") == 4);
    }

    public function testOutOfBoundsCommandsMatrix()
    {
        $this->setExpectedException(\Exception::class);
        $matrix = new \App\Matrix(4);
        $matrix->runCommand("UPDATE 2 9 2 4");
    }

}
