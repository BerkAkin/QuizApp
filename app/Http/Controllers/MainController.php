<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MesajRequest;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Message;
use App\Models\User;
use App\Charts\TotalChart;

class MainController extends Controller
{
    public function Dashboard()
    {
        parent::Logla('Dashboard', 'Dashboard Ekranına Girildi');

        $dogrularim = Result::where('user_id', auth()->user()->id)->sum('correct');
        $yanlislarim = Result::where('user_id', auth()->user()->id)->sum('wrong');


        $chart = new TotalChart('Toplam Doğru Yanlış', true, true);
        $chart->labels(['Doğru', 'Yanlış']);
        $dataset = $chart->dataset('total', 'doughnut', [$dogrularim, $yanlislarim]);
        $dataset->backgroundColor(collect(['#77dd77', '#ff6961',]));
        $dataset->color(collect(['#77dd77', '#ff6961']));

        $sonuclarim = Result::where('user_id', auth()->user()->id)->join('quizzes', 'quizzes.id', '=', 'results.quiz_id')->get(['quizzes.title', 'results.score', 'results.correct', 'results.wrong']);

        $basliklar = $sonuclarim->pluck('title');

        $chart2 = new TotalChart('Sınav Puanları', true, false);
        $chart2->labels($basliklar);
        $dataset2 = $chart2->dataset('Sonuç', 'line', $sonuclarim->pluck('score'));
        $dataset2->color('#8BC6FC');

        $chart3 = new TotalChart('Sınavlardaki Doğru Sayısı', true, false);
        $chart3->labels($basliklar);
        $dataset3 = $chart3->dataset('Sonuç', 'bar', $sonuclarim->pluck('correct'));
        $dataset3->backgroundColor('#77dd77');
        $dataset3->color('#77dd77');

        $chart4 = new TotalChart('Sınavlardaki Yanlış Sayısı', true, false);
        $chart4->labels($basliklar);
        $dataset4 = $chart4->dataset('Sonuç', 'bar', $sonuclarim->pluck('wrong'));
        $dataset4->backgroundColor('#C70039');
        $dataset4->color('#C70039');

        $quizzes = Quiz::where('status', '=', 'published')->where('sahip', '=', auth()->user()->ogretmen_id)->WithCount('questions')->paginate(5);
        $userMessages = Message::where('alici_id', auth()->user()->id)->join('users', 'users.id', '=', 'messages.gonderen_id')->orderBy('id', 'desc')->get([
            'messages.id',
            'messages.baslik',
            'messages.mesaj',
            'messages.okundu_bilgisi',
            'messages.created_at',
            'users.name'
        ]);
        $yeniler = Message::where('okundu_bilgisi', "0")->where('alici_id', auth()->user()->id)->get()->count();
        $kullanicilar = User::where('ogretmen_id', auth()->user()->id)->get(['id', 'name']);
        $ogretmenler = User::where('type', '!=', 'ustYonetici')->get(['name', 'email', 'id', 'type']);
        $yoneticiler = User::where('type', '=', 'ustYonetici')->get(['name', 'email', 'id']);
        $gidenMesajlar = Message::where('gonderen_id', auth()->user()->id)->join('users', 'users.id', '=', 'messages.alici_id')->orderBy('id', 'desc')->get([
            'messages.id',
            'messages.baslik',
            'messages.mesaj',
            'messages.okundu_bilgisi',
            'messages.created_at',
            'users.name'
        ]);
        return view('dashboard', compact(['quizzes', 'userMessages', 'yeniler', 'kullanicilar', 'ogretmenler', 'yoneticiler', 'gidenMesajlar', 'chart', 'chart2', 'chart3', 'chart4']));
    }

    public function quizDetail($slug)
    {
        $quiz = Quiz::whereSlug($slug)->with('myResult', 'siralama.user')->withCount('questions')->first() ?? abort(404, 'Sınav Bulunamadı');
        return view('quizDetail', compact('quiz'));
    }

    public function quiz($slug)
    {
        parent::Logla('Sınava Girildi', 'Sınava Girildi', $slug);
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

            parent::Logla('Sınava Girildi', 'Sınav Tamamlandı (Başarılı)', $quiz->title);
            return redirect()->route('quiz.detail', $quiz->slug)->withSuccess('Sınav tamamlandı');

        } else {

            parent::Logla('Sınava Girildi', 'Sınav Tamamlandı (Başarısız)', $quiz->title);
            return redirect()->route('quiz.detail', $quiz->slug)->withErrors('Sınav süresi dolduğu veya daha önce katılım sağlandığı için sonuçlar kaydedilmedi');
        }
    }


    public function okundIsaretle($id)
    {
        Message::where('id', '=', $id)->update(['okundu_bilgisi' => "1"]);
        return redirect()->back();
    }

    public function mesajGonder(MesajRequest $request)
    {
        try {
            if (auth()->user()->type == "admin") {

                Message::create([
                    'gonderen_id' => auth()->user()->id,
                    'alici_id' => $request->ogrenci,
                    'baslik' => $request->baslik,
                    'mesaj' => $request->mesaj
                ]);


                parent::Logla('Mesajlar', 'Mesaj Gönderildi (Öğretmen->Öğrenci)');

                return redirect()->back()->withSuccess('Mesaj Başarıyla Gönderildi');
            } else if (auth()->user()->type == "user") {
                if ($request->filled('adminId')) {
                    Message::create([
                        'gonderen_id' => auth()->user()->id,
                        'alici_id' => $request->adminId,
                        'baslik' => $request->baslik,
                        'mesaj' => $request->mesaj
                    ]);

                    parent::Logla('Mesajlar', 'Mesaj Gönderildi (Öğrenci->Admin)');

                } else {
                    Message::create([
                        'gonderen_id' => auth()->user()->id,
                        'alici_id' => auth()->user()->ogretmen_id,
                        'baslik' => $request->baslik,
                        'mesaj' => $request->mesaj
                    ]);

                    parent::Logla('Mesajlar', 'Mesaj Gönderildi (Öğrenci->Öğretmen)');

                }
                return redirect()->back()->withSuccess('Mesaj Başarıyla Gönderildi');
            } else {
                Message::create([
                    'gonderen_id' => auth()->user()->id,
                    'alici_id' => $request->ogrenci,
                    'baslik' => $request->baslik,
                    'mesaj' => $request->mesaj
                ]);

                parent::Logla('Mesajlar', 'Mesaj Gönderildi (Admin->Öğrenci)');


                return redirect()->back()->withSuccess('Mesaj Başarıyla Gönderildi');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Mesaj Gönderilemedi');
        }

    }



    public function tipGuncelle($id, $type)
    {
        $userdat = User::where('id', $id)->pluck('name');
        if ($type == 'user') {
            User::where('id', '=', $id)->update(['type' => "admin"]);

            parent::Logla('Tip Güncelleme', 'Tip Değiştirildi (Öğrenci->Öğretmen)', $userdat[0]);

        } else {
            User::where('id', '=', $id)->update(['type' => "user"]);
            parent::Logla('Tip Güncelleme', 'Tip Değiştirildi (Öğretmen->Öğrenci)', $userdat[0]);

        }

        return redirect()->back();
    }

}