<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Http\Requests\QuizCreateRequest;
use App\Http\Requests\QuizUpdateRequest;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        //kullanıcıların yalnızca kendi sınavlarını görüntüleyebilmesi için
        $quizzes = Quiz::withCount('questions')->where('sahip', '=', auth()->user()->id);

        if (request()->get('title')) {
            $quizzes = $quizzes->where('title', 'LIKE', "%" . request()->get('title') . "%");
        }

        if (request()->get('status')) {
            $quizzes = $quizzes->where('status', request()->get('status'));
        }

        $quizzes = $quizzes->paginate(5);
        parent::Logla('Sınavlar', 'Sınavlar Sayfasına Girildi');

        return view('admin.quiz.list', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $sahip = auth()->user()->id;
        return view('admin.quiz.create', ['sahip' => $sahip]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizCreateRequest $request)
    {
        //Veritabanındaki sütunlar ve html tarafındaki nameler aynı ise kalıtım alıp ayrı ayrı $ ile sütunları belirtmeye gerek yok
        //ancak model dosyanda protected $fillable=[] dizisi içinde alanlarını string tipinden yazman gerekiyor.

        if ($request->post('sahip') == auth()->user()->id) {
            Quiz::create($request->post());

            parent::Logla('Sınavlar', 'Sınav Oluşturma Başarılı', $request->post('title'));
            return redirect()->route('quizzes.index')->withSuccess('Sınav Başarıyla Oluşturuldu');
        } else {
            parent::Logla('Sınavlar', 'Sınav Oluşturma Başarısız', $request->post('title'));
            return redirect()->route('quizzes.index')->withErrors('Sınav Oluşturma Başarısız, lütfen kendi hesabınıza sınav oluşturun');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::withCount('questions')->find($id) ?? abort(404, 'Böyle bir sınav mevcut değil');
        return view('admin.quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizUpdateRequest $request, $id)
    {
        Quiz::find($id)->update($request->except(['_method', '_token']));
        parent::Logla('Sınavlar', 'Sınav Düzenlendi', $request->post('title'));
        return redirect()->route('quizzes.index')->withSuccess('Sınav Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id) ?? abort(404, 'Silinmek İstenen Sınav Mevcut Değil');
        $quiz->delete();
        parent::Logla('Sınavlar', 'Sınav Silindi', $quiz->title);

        return redirect()->route('quizzes.index')->withSuccess('Sınav Silme Başarılı');
    }
}