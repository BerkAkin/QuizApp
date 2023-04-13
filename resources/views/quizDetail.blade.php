<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>
    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">
                    <div class="row">
                        <div class="col-md-5">


                            {{-- sol kısım --}}
                            <ol class="list-group list-group-numbered">
                                @if($quiz->finished_at)
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                        Bitiş
                                        </div>
                                        <span title="{{$quiz->finished_at}}" class="badge bg-dark rounded-pill">{{$quiz->finished_at->diffForHumans()}}</span>
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
                                    Girecek Öğrenci
                                  </div>
                                  <span class="badge bg-dark rounded-pill">120</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                  <div class="ms-2 me-auto">
                                    Alınması Gereken Min Not
                                  </div>
                                  <span class="badge bg-dark rounded-pill">60</span>
                                </li>
                              </ol>

                        </div>


                        {{-- sağ kısım --}}
                        <div class="col-md-7"> {{$quiz->description}}
                            <div class="gap-2 d-grid mt-2">
                                <a href="#" class="btn btn-success btn-block">Sınava Katıl</a>
                            </div>
                        </div>
                    </div>
                </p>

                </div>
            </div>
        </div>


    </div>

</x-app-layout>
