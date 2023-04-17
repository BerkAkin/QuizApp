<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>

            <div class="card">
                <div class="card-body">
                        <form method="POST" action="{{route('quiz.result',$quiz->slug)}}">
                            @csrf
                            @foreach($quiz->questions as $question)
                                <span class="text-dark fw-bold ">Soru {{$loop->iteration}} </span>
                                @if($question->image)
                                    <img src="{{asset($question->image)}}" class="img-responsive" width="25%">
                                @endif
                                <br><span class="text-muted">{{$question->question}}</span>
                                
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="quiz{{$question->id}}1" value="answer1" required>
                                    <label class="form-check-label" for="quiz{{$question->id}}1">
                                    {{$question->answer1}}
                                    </label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="quiz{{$question->id}}2" value="answer2" required>
                                    <label class="form-check-label" for="quiz{{$question->id}}2">
                                    {{$question->answer2}}
                                    </label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="quiz{{$question->id}}3" value="answer3" required>
                                    <label class="form-check-label" for="quiz{{$question->id}}3">
                                    {{$question->answer3}}
                                    </label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="quiz{{$question->id}}4" value="answer4" required>
                                    <label class="form-check-label" for="quiz{{$question->id}}4">
                                    {{$question->answer4}}
                                    </label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="{{$question->id}}" id="quiz{{$question->id}}5" value="answer5" required>
                                    <label class="form-check-label" for="quiz{{$question->id}}5">
                                    {{$question->answer5}}
                                    </label>
                                </div>
                                <hr>
                            @endforeach                           
                            <div class="gap-2 d-grid mt-5">
                                <button type="submit" class="btn btn-success">Sınavı Bitir</button>
                            </div>
                        </form>
                </div>
            </div>


</x-app-layout>
