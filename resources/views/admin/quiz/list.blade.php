<x-app-layout>
    <x-slot name="header">Sınavlar</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title float-right">
                <a href="{{route('quizzes.create')}}" class="btn btn-md btn-success"><i class="fa fa-plus"></i> Sınav Yarat</a>
            </h5>
            <form method="GET" action="">
                <div class="row">
                    <div class="col-md-3"><input type="text" name="title" class="form-control" placeholder="Sınav Adıyla Ara" value="{{request()->get('title')}}"></div>
                    <div class="col-md-3">
                        <select class="form-control" name="status" onchange="this.form.submit()">
                            <option value="">Sınav Durumu Seçin</option>
                            <option @if(request()->get('status')=='passive') selected @endif  value="passive">Sınav Bitti</option>
                            <option @if(request()->get('status')=='draft') selected @endif value="draft">Sınav Hazırlanıyor</option>
                            <option @if(request()->get('status')=='published') selected @endif value="published">Sınav Aktif</option>
                        </select>
                    </div>
                    @if(request()->get('title') ||request()->get('status'))
                    <div class="col-md-3">
                        <a href="{{route('quizzes.index')}}" class="btn btn-dark"> Filtreyi Temizle </a>
                    </div>
                    @endif 
                </div>
            </form>
        </div>
            <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">Sınav Adı</th>
                    <th class="text-center" scope="col">Soru Miktarı</th>
                    <th class="text-center" scope="col">Durum</th>
                    <th class="text-center" scope="col">Sınav Süresi</th>
                    <th class="text-center" scope="col">Katılacak Kişi Sayısı</th>
                    <th class="text-center" scope="col">Minimum Not</th>
                    <th class="text-center" scope="col">Bitiş Tarihi</th>
                    <th class="text-center" scope="col">İşlemler</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $quiz)
                    <tr>
                        <td>{{$quiz->title}}</td>
                        <td class="text-center">{{$quiz->questions_count}}</td>
                        <td class="text-center">
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
                        <td class="text-center">{{$quiz->counter}}</td>
                        <td class="text-center">{{$quiz->kisi_sayisi}}</td>
                        <td class="text-center text-primary">{{$quiz->gereken_min_not}}</td>
                        <td class="text-center">{{$quiz->finished_at ? $quiz->finished_at->diffForHumans(): "Bitiş Tarihi Yok"}}</td>
                        <td class="text-center">
                            <a href="{{route('questions.index',$quiz->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-add"></i></a>
                            <a href="{{route('quizzes.edit',$quiz->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{route('quizzes.destroy',$quiz->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div  class="m-2">{{$quizzes->withQueryString()->links()}}</div>
            
    </div>
</x-app-layout>

