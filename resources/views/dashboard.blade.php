<x-app-layout>
    <x-slot name="header">Sınavlar</x-slot>

<div class="row">
    <div class="col-md-12">
        <div class="list-group">
            @foreach($quizzes as $quiz)
                <a href="{{route('quiz.detail', $quiz->slug)}}" class="list-group-item list-group-item-action mt-5" aria-current="true">
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



    <div class="col-md-4"></div>
</div>
    


</x-app-layout>
