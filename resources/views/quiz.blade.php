<x-app-layout>
    
    <x-slot name="header">{{$quiz->title}}</x-slot>
<style>
#sayac {
  position: fixed;
  bottom: 50px;
  right: 50px;
  z-index: 99;
  font-size: 1em;
  outline: none;
  background-color: rgb(47, 128, 0);
  color: white;
  padding: 5px;
  border-radius: 4px;

}

        /* width */
        ::-webkit-scrollbar {
        width: 10px;
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
</style>

    <div id="sayac"></div>

            <p id="suankiTarih" class="d-none">{{$quiz->finished_at}}</p>
            <div class="card">
                <div class="card-body">
                        <form method="POST" action="{{route('quiz.result',$quiz->slug)}}">
                            @csrf
                            @foreach($quiz->questions as $question)
                                <span class="fw-bold" style="color:rgb(3, 101, 180)">Soru {{$loop->iteration}} </span>
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



            <x-slot name="js">
                <script>
                    
                    let tarih = document.querySelector(`#suankiTarih`);
                    var now = new Date(tarih.innerHTML);

                    function fark(dt2, dt1) 
                    {
                        var frk =(dt2.getTime() - dt1.getTime()) / 1000;
                        frk /= 60;
                        return Math.abs(Math.round(frk));
                    }
                    
                    var now2 = new Date();

                    const element = document.getElementById("sayac");
                    if(now>now2)
                    {
                        var sayac = setInterval(function() {
                            var now2 = new Date();
                            element.innerHTML = fark(now,now2) + " Dakika Kaldı"
                            if (fark(now,now2) <= 10) {
                                element.innerHTML = fark(now,now2) + " Dakika Kaldı"
                                element.style.backgroundColor="orange";
                                element.style.color="black";
                                clearInterval(sayac);
                            } 
                            if (fark(now,now2) <= 0) {
                                element.innerHTML = " Süre Bitti";
                                element.style.color="white";
                                element.style.backgroundColor="red";
                                clearInterval(sayac);
                            } 
                        
                        }, 1000);
                    }
                </script>
        
            </x-slot>
</x-app-layout>
