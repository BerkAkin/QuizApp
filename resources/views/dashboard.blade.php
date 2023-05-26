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
        .accordion-button::after 
        {
            
            transform: none !important;
            transition: none !important;
            visibility: hidden;
        }        


    </style>
@if(auth()->user()->type=='admin')
<div class="row">

    <div class="col-md-12">
        <h5 class="display-6 text-center">Mesajlar</h5>
        <hr>
        <div class="card bg-dark" style="width: 100%;">
            @if($yeniler=="0")
            <div class="card-header h6 text-warning fw-bold ">
                <span>Yeni Mesajınız Yok</span>
                @else
                <div class="card-header h6 text-success fw-bold">
                    {{$yeniler}} Yeni Mesajınız Var !
                @endif
                <a class="float-end btn-sm btn btn-warning fw-bold"><i class="fa-solid fa-pencil"></i></a>
              </div>

        
              @foreach($userMessages as $item)
              <div class="accordion bg-light" style="margin: 0.5px" id="accordionExample">
                  <div class="accordion-item  border-bottom-0 border-start-0 border-end-0 rounded-0">
                      <h2 class="accordion-header" id="headingOne">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                              <span class=" w-100  fw-bold text-capitalize @if($item->okundu_bilgisi==1) text-dark @else text-success @endif">{{Str::limit($item->baslik,25)}}
                                  @if($item->okundu_bilgisi==0)<span class="float-end badge bg-success rounded-pill"> Yeni</span> @endif 

                              </span>          
                          </button>
                      </h2>
                     
                      <div id="collapse{{$item->id}}" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                              <div class="text-muted">{{$item->mesaj}}</div>
                              <hr>
                              <div>
                                  <div class=" badge mt-3 ms-0 bg-info rounded-pill text-dark">Gönderen: {{$item->name}}</div>
                                  <div class="float-end badge mt-3 ms-0 bg-warning rounded-pill text-dark">{{$item->created_at->diffForHumans()}}</div>
                              </div>
                               
                              @if($item->okundu_bilgisi==0)
                              <a href="{{route('okundu', $item->id)}}" class="mt-4 btn btn-sm btn-success w-100 fw-bold"><i class="fa-regular fa-envelope-open"></i> Okundu Olarak İşaretle</a>
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
          @endforeach
            </div>
        </div>
    </div>




</div>
@else
<div class="row">
    <div class="col-md-7">
        <h5 class="display-6">Sınavlar</h5>
        <hr>
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

    <div class="col-md-5">
        <h5 class="display-6 text-center">Mesajlar</h5>
        <hr>
        <div class="card" style="width: 100%; background-color:rgb(0, 0, 0)">
            
            @if($yeniler=="0")
            <div class="card-header h6 text-warning fw-bold">
                    Yeni Mesajınız Yok
                @else
                <div class="card-header h6 text-success fw-bold">
                    {{$yeniler}} Yeni Mesajınız Var !
                    
                @endif
                <a class="float-end btn-sm btn btn-warning fw-bold"><i class="fa-solid fa-pencil"></i></a>
              </div>

        
                @foreach($userMessages as $item)
                    <div class="accordion bg-light" style="margin: 0.5px" id="accordionExample">
                        <div class="accordion-item  border-bottom-0 border-start-0 border-end-0 rounded-0">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                                    <span class=" w-100  fw-bold text-capitalize @if($item->okundu_bilgisi==1) text-dark @else text-success @endif">{{Str::limit($item->baslik,25)}}
                                        @if($item->okundu_bilgisi==0)<span class="float-end badge bg-success rounded-pill"> Yeni</span> @endif 
                                        
                                    </span>          
                                </button>
                            </h2>
                           
                            <div id="collapse{{$item->id}}" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="text-muted">{{$item->mesaj}}</div>
                                    <hr>
                                    <div>
                                        <div class=" badge mt-3 ms-0 bg-info rounded-pill text-dark">Gönderen: {{$item->name}}</div>
                                        <div class="float-end badge mt-3 ms-0 bg-warning rounded-pill text-dark">{{$item->created_at->diffForHumans()}}</div>
                                    </div>
                                     
                                    @if($item->okundu_bilgisi==0)
                                    <a href="{{route('okundu', $item->id)}}" class="mt-4 btn btn-sm btn-success w-100 fw-bold"><i class="fa-regular fa-envelope-open"></i> Okundu Olarak İşaretle</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>




</div>
@endif


    
<x-slot name='js'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</x-slot>

</x-app-layout>
