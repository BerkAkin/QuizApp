<x-app-layout>
    <x-slot name="header">Sınavlar</x-slot>

<div class="row">
    <div class="col-md-12">
        <div class="list-group">
            @foreach($quizzes as $quiz)
                <a href="{{route('quiz.detail', $quiz->slug)}}" class="list-group-item list-group-item-action mt-5" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 text-dark">{{$quiz->title}}</h5>
                        <small class="text-primary bold fw-bold">{{$quiz->finished_at ? $quiz->finished_at->diffForHumans() . " bitiyor": null}}</small>
                    </div>
                    <p class="mb-1 text-muted">{{Str::limit($quiz->description,150)}}</p>
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
