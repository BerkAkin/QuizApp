<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use Illuminate\Support\Str;

class QuestionController extends Controller
{



    public function index($id)
    {

        parent::Logla('Sorular', 'Sınav Soruları Sayfasına Girildi');
        $quiz = Quiz::whereId($id)->with('questions')->first() ?? abort(404, 'Sınav Mevcut Değil');
        return view('admin.question.list', compact('quiz'));
    }



    public function create($id)
    {
        $quiz = Quiz::find($id);
        return view('admin.question.create', compact('quiz'));
    }



    public function store(QuestionCreateRequest $request, $id)
    {

        if ($request->hasFile('image')) {
            $dosyaAdi = Str::slug($request->question) . "." . $request->image->extension();
            $dosyaAdiYeni = 'uploads/' . $dosyaAdi;
            $request->image->move(public_path('uploads'), $dosyaAdi);
            $request->merge([
                'image' => $dosyaAdiYeni,
            ]);
        }
        Quiz::find($id)->questions()->create($request->post());
        parent::Logla('Sorular', 'Sınava Soru Oluşturuldu');
        return redirect()->route('questions.index', $id)->withSuccess('Soru Başarıyla Oluşturuldu');
    }




    public function show($quiz_id, $id)
    {
        return "";
    }



    public function edit($quiz_id, $question_id)
    {
        $question = Quiz::find($quiz_id)->questions()->whereId($question_id)->first() ?? abort(404, 'Sınav veya Soru Mevcut Değil');
        return view('admin.question.edit', compact('question'));
    }




    public function update(QuestionUpdateRequest $request, $quiz_id, $question_id)
    {

        if ($request->hasFile('image')) {
            $dosyaAdi = Str::slug($request->question) . "." . $request->image->extension();
            $dosyaAdiYeni = 'uploads/' . $dosyaAdi;
            $request->image->move(public_path('uploads'), $dosyaAdi);
            $request->merge([
                'image' => $dosyaAdiYeni,
            ]);
        }
        Quiz::find($quiz_id)->questions()->whereId($question_id)->first()->update($request->post());
        parent::Logla('Sorular', 'Sınav Sorusu Düzenlendi');
        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru Başarıyla Güncellendi');
    }




    public function destroy($quiz_id, $question_id)
    {
        Quiz::find($quiz_id)->questions()->whereId($question_id)->delete();
        parent::Logla('Sorular', 'Sınav Sorusu Silindi');
        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru Silme Başarılı');
    }
}