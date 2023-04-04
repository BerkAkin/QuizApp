<x-app-layout>
    <x-slot name="header">{{$question->question}}</x-slot>

    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" action="{{route('questions.update',[$question->quiz_id,$question->id])}}" method="POST">
             @csrf
             @method('PUT')
             <div class="form-group"> 

                <label class="fw-bold" for="title">Soru</label>
                <textarea style="margin-top:20px" name="question" class="form-control" rows="4" >{{$question->question}}</textarea>
            </div>
            <div class="form-group mt-3">
                <label class="fw-bold" for="description">Fotoğraf</label>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        @if($question->image)
                        <a target="_blank" href="{{asset($question->image)}}" >
                            <img style="width: 300px" src="{{asset($question->image)}}">
                        </a>
                        @endif
                    </div>
                    <div class="col-4"></div>
                </div>
                <input type="file" name="image" class="form-control mt-4">
            </div>
            <div class="row mt-4">
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label class="fw-bold" for="answer1">1. Cevap</label>
                        <textarea name="answer1" class="form-control" rows="2" >{{$question->answer1}}</textarea>
                    </div>
                </div> 
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label class="fw-bold" for="answer2">2. Cevap</label>
                        <textarea name="answer2" class="form-control" rows="2" >{{$question->answer2}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label class="fw-bold" for="answer3">3. Cevap</label>
                        <textarea name="answer3" class="form-control" rows="2" >{{$question->answer3}}</textarea>
                    </div>
                </div> 
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label class="fw-bold" for="answer4">4. Cevap</label>
                        <textarea name="answer4" class="form-control" rows="2" >{{$question->answer4}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label class="fw-bold" for="answer5">5. Cevap</label>
                        <textarea name="answer5" class="form-control" rows="2" >{{$question->answer5}}</textarea>
                    </div>
                </div> 
            </div>

            <div class="form-check mt-3">
                <label class="fw-bold" for="correct_answer">Doğru Cevap</label>
                <select name="correct_answer" class="form-control">
                    <option @if($question->correct_answer==='answer1') selected @endif  value="answer1">1. Cevap</option>
                    <option @if($question->correct_answer==='answer2') selected @endif  value="answer2">2. Cevap</option>
                    <option @if($question->correct_answer==='answer3') selected @endif  value="answer3">3. Cevap</option>
                    <option @if($question->correct_answer==='answer4') selected @endif  value="answer4">4. Cevap</option>
                    <option @if($question->correct_answer==='answer5') selected @endif  value="answer5">5. Cevap</option>
                </select>
            </div>
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-success btn-sm fs-5">Soru Güncelle</button>
            </div>

            </form>
        </div>
    </div>
</x-app-layout>
