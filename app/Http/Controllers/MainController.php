<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class MainController extends Controller
{
    public function Dashboard()
    {
        $quizzes = Quiz::where('status', 'published')->WithCount('questions')->paginate(5);
        return view('dashboard', compact('quizzes'));
    }

    public function quizDetail($slug)
    {
        $quiz = Quiz::whereSlug($slug)->withCount('questions')->first() ?? abort(404, 'Sınav Bulunamadı');
        return view('quizDetail', compact('quiz'));
    }

    public function quiz($slug)
    {
        $quiz = Quiz::whereSlug($slug)->with('questions')->first();
        return view('quiz', compact('quiz'));
    }
}