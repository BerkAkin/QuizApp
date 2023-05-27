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
        .form-control:focus 
        {
            border-color: rgb(192, 191, 191);
            box-shadow: none;
        }

        /* width */
        ::-webkit-scrollbar {
        width: 5px;
        border-radius: 5px;

        }

        /* Track */
        ::-webkit-scrollbar-track {
        background: #c7c7c7; 
        border-radius: 5px;

        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #ffd900; 
        border-radius: 5px;
        }


        .nav-tabs .nav-item .nav-link {
            background-color: #8f9aa3;
            border: none;
            color: #ffffff;
            margin-left: 10px;
            }

            .nav-tabs .nav-item .nav-link.active {
            background-color: #ffc107;
            transform: scale(1.1,1.1);
            color: #000000;
            border: none;
            }

            .tab-content {
            margin-top:10px;
            border: none;
            }

            .tab-content .tab-pane {
            border: none;
            background-color: #FFF;
            }
    </style>




@if(auth()->user()->type=='admin')
    <div class="row">

        <div class="col-md-12 ">

                <div>
                    <ul class="nav nav-tabs border-warning" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-bold" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Gelen Mesajlar  
                                @if($yeniler!="0")
                                <span class="badge bg-success rounded-pill"> {{$yeniler}}</span>
                                @endif
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-bold" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Gönderilmiş Mesajlar</button>
                        </li>
                        
                        <li class="nav-item ml-auto mr-5">
                            @if($yeniler=="0")
                                <div class="card-header h6 text-danger fw-bold ">
                                <span class="d-inline-block mt-2">Yeni Gelen Mesajınız Yok</span>
                            @else
                                <div class="card-header h6 text-success fw-bold">
                                <span class="d-inline-block mt-2"> {{$yeniler}} Yeni Mesajınız Var !</span>
                            @endif
                                </div>
                        </li>
                        <li class="nav-item "> <a data-bs-toggle="modal" data-bs-target="#staticBackdrop" class=" btn btn-warning fw-bold"><i class="fa-solid fa-pencil"></i></a></li>
                    </ul>
                </div>
            
            <div class="tab-content " id="myTabContent">
                {{-- Gelen Mesajlar --}}
                <div class="tab-pane fade show active " id="home" role="tabpanel" aria-labelledby="home-tab">
                        
                        <!--MESAJLAR BAŞLANGIÇ-->
                            <div class="card border rounded-0 " style="width: 100%;">
                            
                                <div style="max-height: 600px; overflow-y:scroll">
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
                        <!--MESAJLAR BİTİŞ-->
                </div>
                {{-- Giden Mesajlar --}}
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card border rounded-0 " style="width: 100%;">
                            <div style="max-height: 600px; overflow-y:scroll">
                                @foreach($gidenMesajlar as $item)
                                    <div class="accordion bg-light" style="margin: 0.5px" id="accordionExample">
                                        <div class="accordion-item  border-bottom-0 border-start-0 border-end-0 rounded-0">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                                                    <span class=" w-100  fw-bold text-capitalize text-dark  text-success ">{{Str::limit($item->baslik,25)}}
                                                        <span class="float-end">
                                                        @if($item->okundu_bilgisi=="0") 
                                                            <i class="fa-solid fa-envelope"></i>
                                                        @else 
                                                            <i class="fa-solid fa-envelope-open"></i>
                                                        @endif
                                                        </span>
                                                    </span>          
                                                </button>
                                            </h2>
                                            <div id="collapse{{$item->id}}" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="text-muted">{{$item->mesaj}}</div>
                                                    <hr>
                                                    <div>
                                                        <div class=" badge mt-3 ms-0 bg-info rounded-pill text-dark">Gönderilen Kişi: {{$item->name}}</div>
                                                        <div class="float-end badge mt-3 ms-0 bg-warning rounded-pill text-dark">{{$item->created_at->diffForHumans()}}</div>
                                                        
       
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
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
            <div class="card" style="width: 100%; background-color:rgba(192, 192, 192, 0)">
                
                @if($yeniler=="0")
                <div class="card-header h6 text-danger fw-bold">
                    <span class=" d-inline-block mt-2"> Yeni Mesajınız Yok</span>
                    @else
                    <div class="card-header h6 text-success fw-bold">
                        <span class=" d-inline-block mt-2"> {{$yeniler}} Yeni Mesajınız Var !</span>
                        
                    @endif
                    <a data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="float-end btn-sm btn btn-warning fw-bold"><i class="fa-solid fa-pencil"></i></a>
                </div>

                    <div style="max-height: 600px; overflow-y:scroll">
                        @foreach($userMessages as $item)
                            <div class="accordion bg-light " style="margin: 0.5px" id="accordionExample">
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




    </div>
@endif


  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-warning " id="staticBackdropLabel">Mesaj Gönder</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="{{route('mesajg')}}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <span class="input-group-text bg-warning" id="basic-addon1"><i class="fa-regular fa-comment-dots text-lg"></i></span>
                <input minlength="10" maxlength="40" required name="baslik" type="text" class="form-control" placeholder="Konu" aria-label="Username" aria-describedby="basic-addon1">
              </div>
              <div class="input-group">
                <span class="input-group-text bg-warning"><i class="fa-regular fa-message text-lg"></i></span>
                <textarea minlength="10" maxlength="300" required name="mesaj" rows="6" style="resize: none;" placeholder="İçerik" class="form-control" aria-label="With textarea"></textarea>
              </div>
              @if(auth()->user()->type=="admin")

                <div class="input-group mt-3">
                    <label class="input-group-text bg-warning" for=""><i class="fa-regular fa-user text-lg"></i></label>
                    <select required name="ogrenci"  class="form-select" aria-label="Filter select" style="border-color: rgb(192, 191, 191); box-shadow: none;">
                    <option selected></option>

                    @foreach($kullanicilar as $kullanici)
                    <option value="{{$kullanici->id}}">{{$kullanici->name}}</option>
                    @endforeach

                    </select>
                </div>

                @endif
         


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal</button>
          <button type="submit" class="btn btn-success">Gönder</button> 
        </form>
        </div>
      </div>
    </div>
  </div>

    
<x-slot name='js'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</x-slot>

</x-app-layout>
