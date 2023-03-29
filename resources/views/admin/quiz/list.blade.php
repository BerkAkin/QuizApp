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
                    <th scope="col">Durum</th>
                    <th scope="col">Bitiş Tarihi</th>
                    <th scope="col">İşlemler</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $quiz)
                    <tr>
                        <td>{{$quiz->title}}</td>
                        <td>{{$quiz->status}}</td>
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

