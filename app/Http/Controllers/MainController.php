<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TechnicalTest\Problem1;
use App\TechnicalTest\Problem2;
use App\TechnicalTest\Problem3;

class MainController extends Controller
{
    /**
     * Display results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function problem1(Request $request)
    {
        $problem1 = new Problem1();
        $problem1->input = $request->input('input');
        return $problem1->findWinningTeam();
    }

    /**
     * Display results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function problem2(Request $request)
    {
        $problem2 = new Problem2();
        $problem2->input = $request->input('input');
        return $problem2->chessboard();
    }

    /**
     * Display results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function problem3(Request $request)
    {
        $problem3 = new Problem3();
        $problem3->input = $request->input('input');
        return $problem3->getHigherFormulaValue();
    }
}
