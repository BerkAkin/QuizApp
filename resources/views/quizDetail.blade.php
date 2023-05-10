<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">




                      <div class="col-md-4">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title text-center">En Yüksek Not Alan 4 Kişi</h5>
                            <hr>
                            <ul class="list-group">
                              @foreach($quiz->siralama as $item)
                                <li class="list-group-item"><strong class="text-muted">{{$loop->iteration}}.</strong> {{$item->user->name}}</li>
                              @endforeach
                            </ul>
                          </div>
                        </div>
                      </div>




                        <div class="col-md-4">
                            {{-- sol kısım --}}
                            <ol class="list-group list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                  <div class="ms-2 me-auto">Not</div>
                                  @if($quiz->myResult)
                                          <span title="" class="badge bg-info rounded-pill">
                                          {{$quiz->myResult->score}} 
                                        </span>
                                      </li>
                                      <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">Doğru - Yanlış</div>
                                        <span title="" class="badge bg-success rounded-pill">{{$quiz->myResult->correct}}</span>
                                        <span title="" class="badge bg-danger rounded-pill ms-1"> {{$quiz->myResult->wrong}}</span>
                                      </li>
                                      @endif
                                      @if($quiz->finished_at)
                                          <li class="list-group-item d-flex justify-content-between align-items-start">
                                              <div class="ms-2 me-auto">Bitiş</div>
                                              <span title="{{$quiz->finished_at}}" class="badge bg-danger rounded-pill">{{$quiz->finished_at->diffForHumans()}}</span>
                                          </li>
                                    @endif
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                     Soru Sayısı
                                    </div>
                                    <span class="badge bg-dark rounded-pill">{{$quiz->questions_count}}</span>
                                  </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                  <div class="ms-2 me-auto">
                                    Girecek Öğrenci Sayısı
                                  </div>
                                  <span class="badge bg-dark rounded-pill">{{$quiz->kisi_sayisi}} Kişi</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                  <div class="ms-2 me-auto">
                                    Alınması Gereken Minimum Not
                                  </div>
                                  <span class="badge bg-dark rounded-pill">{{$quiz->gereken_min_not}}</span>
                                </li>                                
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                  <div class="ms-2 me-auto">
                                    Sınav Süresi
                                  </div>
                                  <span style="background-color: rgb(255, 187, 0)" class="badge text-dark rounded-pill">{{$quiz->counter}} Dakika</span>
                                </li>
                              </ol>
                        </div>
                        {{-- sağ kısım --}}
                        
                      <div class="col-md-4 card"> 
                        <div class="card-body">
                          <h5 class="text-center">Sınav Açıklaması</h5>
                          <hr>
                          <p class="card-title">{{$quiz->description}}</p>                        
                        </div>
                      </div>
                      <div class="mt-2">
                          @if(date("Y-m-d H:i:s")>$quiz->finished_at)
                          <div class="gap-2 d-grid mt-2">
                            <a class="btn btn-danger btn-block disabled">Sınava Süresi Doldu</a>
                          </div>
                          @else
                          @if(!$quiz->myResult)
                                <div class="gap-2 d-grid mt-2">
                                    <a href="{{route('quiz.join',$quiz->slug)}}" class="btn btn-success btn-block">Sınava Katıl</a>
                                </div>
                            @else
                                <div class="gap-2 d-grid mt-2">
                                  <a class="btn btn-secondary btn-block disabled">Sınava Daha Önce Katıldınız</a>
                                </div>
                            @endif
                          @endif
                      </div>

                    </div>
                </div>
            </div>
        </div>


    </div>

</x-app-layout>
