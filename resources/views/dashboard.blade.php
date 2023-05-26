<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <style>
        .accordion-button:not(.collapsed) 
        {
            background-color: transparent !important;
            color: inherit;
        }

        button.accordion-button:focus
        {
            box-shadow: inherit;
        }
    </style>

<div class="row">
    <div class="col-md-7">
        @if(auth()->user()->type!='admin')
        <h5 class="display-6">Sınavlar</h5>
        <hr>
        @endif
        <div class="list-group">
            @foreach($quizzes as $quiz)
                <a href="{{route('quiz.detail', $quiz->slug)}}" class="list-group-item list-group-item-action mt-2 border" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 text-dark"><span class="fw-bold">Sınav Başlığı: </span>{{$quiz->title}}</h5>
                        @if(date("Y-m-d H:i:s")>$quiz->finished_at)
                            <small class="text-danger bold fw-bold">{{$quiz->finished_at ? $quiz->finished_at->diffForHumans() . " bitti": null}}</small>
                        @else
                            <small class="text-primary bold fw-bold">{{$quiz->finished_at ? $quiz->finished_at->diffForHumans() . " bitiyor": null}}</small>
                        @endif
                    </div>
                    <p class="mb-1 text-muted"><span class="fw-bold">Sınav Açıklaması: </span>{{Str::limit($quiz->description,100)}}</p>
                    <small>Soru Sayısı: {{$quiz->questions_count}}</small>
                </a>
            @endforeach

            <div class="mt-3">
                {{$quizzes->links()}}
            </div>

        </div>
    </div>

    <div class="col-md-5 mt-5">
        <div class="card" style="width: 100%;">
            @if($yeniler=="0")
            <div class="card-header  fw-bold">
                    Yeni Mesajınız Yok
                @else
                <div class="card-header text-success fw-bold">
                    {{$yeniler}} Yeni Mesajınız Var !
                @endif
              </div>

<!--foreach ile dönülecek kısım-->
    @foreach($userMessages as $item)
        <div class="accordion" id="accordionExample">
            <div class="accordion-item border-0">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <span class="fw-bold text-capitalize @if($item->okundu_bilgisi==1) text-dark @else text-success @endif">{{$item->baslik}}</span>                
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <div class="text-muted">{{$item->mesaj}}</div>
                @if($item->okundu_bilgisi==0)
                <a href="{{route('okundu', $item->id)}}" class="mt-4 btn btn-sm btn-success w-100 fw-bold"><i class="fa-regular fa-envelope-open"></i> Okundu Olarak İşaretle</a>
                @endif
                </div>
              </div>
            </div>
          </div>
    @endforeach




        </div>
        {{-- <div class="card mt-5" style="width: 100%;">
            <div class="card-header text-success fw-bold">
              1 Yeni Mesajınız Var
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item border ">
                <div class="fw-bolder text-dark">Mesaj Başlığı</div>
                <div class=" text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut animi cumque autem. Dolore hic aliquam quidem. Repellendus nam sequi laborum fuga? Vel quis facilis quo quaerat alias reiciendis consectetur dolorem. </div>
                <a class="float-end btn btn-sm btn-success"><i class="fa-regular fa-envelope-open"></i>
                </a>
                </li>
              <li class="list-group-item">Mesaj 2</li>
              <li class="list-group-item">Mesaj 3</li>
            </ul>
          </div> --}}
    </div>




</div>
    
<x-slot name='js'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</x-slot>

</x-app-layout>
