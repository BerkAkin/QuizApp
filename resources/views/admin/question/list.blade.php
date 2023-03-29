<x-app-layout>
    <x-slot name="header">{{$quiz->title}} sınavının soruları</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{route('questions.create', $quiz->id)}}" class="btn btn-md btn-success"><i class="fa fa-plus"></i> Soru Oluştur</a>
            </h5>
            </div>
            <table class="table table-hover table-bordered table-sm">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">Soru</th>
                    <th class="text-center" scope="col">Fotoğraf</th>
                    <th class="text-center" scope="col">Birinci Şık</th>
                    <th class="text-center" scope="col">İkinci Şık</th>
                    <th class="text-center" scope="col">Üçüncü Şık</th>
                    <th class="text-center" scope="col">Dördüncü Şık</th>
                    <th class="text-center" scope="col">Beşinci Şık</th>
                    <th class="text-center" scope="col" style="width:100px">Doğru Şık</th>
                    <th class="text-center" scope="col" style="width:80px">İşlemler</th>
                  </tr>
                  @foreach ($quiz->questions as $question)
                    <tr>
                        <td>{{$question->question}}</td>
                        <td>{{$question->image}}</td>
                        <td>{{$question->answer1}}</td>
                        <td>{{$question->answer2}}</td>
                        <td>{{$question->answer3}}</td>
                        <td>{{$question->answer4}}</td>
                        <td>{{$question->answer5}}</td>
                        <td class="text-success fw-bold text-center" >{{substr($question->correct_answer, -1). ".Şık "}}</td>
                        <td class="text-center">
                            <a href="{{route('quizzes.edit',$question->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{route('quizzes.destroy',$question->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
</x-app-layout>

