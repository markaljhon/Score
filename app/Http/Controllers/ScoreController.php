<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends Controller
{
    public function index($value = '?') {
        return view('score', ['score' => $value]);
    }

    public function store() {
        $min = 1;
        $max = 6;
        $score = new Score;
        $score->value = rand($min, $max);
        $score->save();

        return redirect('/score/'.$score->value);
    }
}
