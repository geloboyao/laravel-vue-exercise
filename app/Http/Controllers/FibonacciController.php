<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;

class FibonacciController extends Controller
{
    public function index()
    {
        return view('layout')
            ->with('title', 'Fibonacci');
    }

    public function show(Request $request)
    {
        if ($request->input == 1) {
            echo json_encode(['status' => 'success', 'answer' => 1]);
            exit;
        }

        $num1 = 1;
        $num2 = 1;

        for ($i = 3; ; $i++) {
            $temp = $num1 + $num2;
            $num1 = $num2;
            $num2 = $temp;

            if ($temp == $request->input) {
                echo json_encode(['status' => 'success', 'answer' => $i]);
                exit;
            } elseif ($temp > $request->input) {
                echo json_encode(['status' => 'failed']);
                exit;
            }
        }
    }

    public function test()
    {
        $key = 33 - 2;

        $num1 = 1;
        $num2 = 1;

        for ($i = 0; $i < $key; $i++) {
            $temp = $num1 + $num2;
            $num1 = $num2;
            $num2 = $temp;
        }

        echo json_encode(['answer' => $num2]);
    }
}
