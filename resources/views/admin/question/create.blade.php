<x-app-layout>
    <x-slot name="header">{{$quiz->title}} Sınavına Yeni Soru Ekle</x-slot>

    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" action="{{route('questions.store',$quiz->id)}}" method="POST">
             @csrf
             <div class="form-group">
                <label class="fw-bold" for="title">Soru</label>
                <textarea name="question" class="form-control" rows="4" >{{old('question')}}</textarea>
            </div>
            <div class="form-group mt-3">
                <label class="fw-bold" for="description">Fotoğraf</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="row mt-4">
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label class="fw-bold" for="answer1">1. Cevap</label>
                        <textarea name="answer1" class="form-control" rows="2" >{{old('answer1')}}</textarea>
                    </div>
                </div> 
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label class="fw-bold" for="answer2">2. Cevap</label>
                        <textarea name="answer2" class="form-control" rows="2" >{{old('answer2')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label class="fw-bold" for="answer3">3. Cevap</label>
                        <textarea name="answer3" class="form-control" rows="2" >{{old('answer3')}}</textarea>
                    </div>
                </div> 
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label class="fw-bold" for="answer4">4. Cevap</label>
                        <textarea name="answer4" class="form-control" rows="2" >{{old('answer4')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label class="fw-bold" for="answer5">5. Cevap</label>
                        <textarea name="answer5" class="form-control" rows="2" >{{old('answer5')}}</textarea>
                    </div>
                </div> 
            </div>

            <div class="form-check mt-3">
                <label class="fw-bold" for="correct_answer">Doğru Cevap</label>
                <select name="correct_answer" class="form-control">
                    <option @if(old('correct_answer')==='answer1') selected @endif  value="answer1">1. Cevap</option>
                    <option @if(old('correct_answer')==='answer2') selected @endif  value="answer2">2. Cevap</option>
                    <option @if(old('correct_answer')==='answer3') selected @endif  value="answer3">3. Cevap</option>
                    <option @if(old('correct_answer')==='answer4') selected @endif  value="answer4">4. Cevap</option>
                    <option @if(old('correct_answer')==='answer5') selected @endif  value="answer5">5. Cevap</option>
                </select>
            </div>
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-success btn-sm fs-5">Soru Yarat</button>
            </div>

            </form>
        </div>
    </div>
</x-app-layout>
