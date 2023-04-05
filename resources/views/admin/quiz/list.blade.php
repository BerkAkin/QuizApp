<x-app-layout>
    <x-slot name="header">Sınavlar</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{route('quizzes.create')}}" class="btn btn-md btn-success"><i class="fa fa-plus"></i> Sınav Yarat</a>
            </h5>
            </div>
            <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Sınav Adı</th>
                    <th scope="col">Soru Miktarı</th>
                    <th scope="col">Durum</th>
                    <th scope="col">Bitiş Tarihi</th>
                    <th scope="col">İşlemler</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $quiz)
                    <tr>
                        <td>{{$quiz->title}}</td>
                        <td>{{$quiz->questions_count}}</td>
                        <td>
                           @switch($quiz->status)
                               @case('published')
                                  <span class="badge bg-success text-dark">Sınav Aktif</span>      
                               @break
                               @case('draft')
                               <span class="badge bg-warning text-dark">Sınav Hazırlanıyor</span>
                                   @break
                               @case('passive')
                               <span class="badge bg-danger text-dark">Sınav Bitti</span>
                                   @break
                                   
                           @endswitch
                        </td>
                        <td>{{$quiz->finished_at}}</td>
                        <td>
                            <a href="{{route('questions.index',$quiz->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-add"></i></a>
                            <a href="{{route('quizzes.edit',$quiz->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{route('quizzes.destroy',$quiz->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$quizzes->links()}}
        </div>
</x-app-layout>

