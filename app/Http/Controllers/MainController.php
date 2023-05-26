<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Message;

class MainController extends Controller
{
    public function Dashboard()
    {

        $quizzes = Quiz::where('status', '=', 'published')->where('sahip', '=', auth()->user()->ogretmen_id)->WithCount('questions')->paginate(5);
        $userMessages = Message::where('alici_id', auth()->user()->id)->get();
        $yeniler = Message::where('okundu_bilgisi', "0")->where('alici_id', auth()->user()->id)->get()->count();
        return view('dashboard', compact(['quizzes', 'userMessages', 'yeniler']));
    }

    public function quizDetail($slug)
    {
        $quiz = Quiz::whereSlug($slug)->with('myResult', 'siralama.user')->withCount('questions')->first() ?? abort(404, 'Sınav Bulunamadı');
        return view('quizDetail', compact('quiz'));
    }

    public function quiz($slug)
    {
        $quiz = Quiz::whereSlug($slug)->with('questions')->first();
        return view('quiz', compact('quiz'));
    }

    public function result(Request $request, $slug)
    {

        $quiz = Quiz::with('questions')->whereSlug($slug)->first() ?? abort(404, 'Sınav Mevcut Değil');
        $kayitVarMi = Result::where('user_id', '=', auth()->user()->id)->where('quiz_id', $quiz->id)->value('quiz_id');

        if ((date("Y-m-d H:i:s") < $quiz->finished_at || $quiz->finished_at == null) && $kayitVarMi == null) {
            $correct = 0;
            foreach ($quiz->questions as $question) {
                /*  echo $question->id . '-' . $question->correct_answer . '/' . $request->post($question->id) . '<br>'; */
                Answer::create([
                    'user_id' => auth()->user()->id,
                    'question_id' => $question->id,
                    'answer' => $request->post($question->id)
                ]);

                if ($question->correct_answer === $request->post($question->id)) {
                    $correct += 1;
                }
            }
            $score = round((100 / count($quiz->questions)) * $correct);
            $wrong = count($quiz->questions) - $correct;
            Result::create([
                'user_id' => auth()->user()->id,
                'quiz_id' => $quiz->id,
                'score' => $score,
                'correct' => $correct,
                'wrong' => $wrong,

            ]);

            return redirect()->route('quiz.detail', $quiz->slug)->withSuccess('Sınav tamamlandı');
        } else {
            return redirect()->route('quiz.detail', $quiz->slug)->withErrors('Sınav süresi dolduğu veya daha önce katılım sağlandığı için sonuçlar kaydedilmedi');
        }
    }


    public function okundIsaretle($id)
    {
        Message::where('id', '=', $id)->update(['okundu_bilgisi' => "1"]);
        return redirect()->back();
    }

}