<x-app-layout>
    <x-slot name="header">Sınavı Güncelle</x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{route('quizzes.update', $quiz->id)}}" method="POST">
            @method('PUT')
             @csrf
             <div class="form-group">
                <label class="fw-bold" for="title">Sınav Başlığı</label>
                <input type="text" name="title" class="form-control" required value="{{$quiz->title}}">
            </div>
            <div class="form-group mt-3">
                <label class="fw-bold" for="description">Sınav Açıklaması</label>
                <textarea name="description" class="form-control" rows="4">{{$quiz->description}}</textarea>
            </div>
            <div class="form-group mt-3">
                <label>Sınav Durumu</label><br>
                <label>-Sınavı yayınlayabilmek için en az 5 soru eklemelisiniz-</label>
                <select name="status" class="form-control">
                    <option @if($quiz->questions_count<5) disabled @endif @if($quiz->status === 'published') selected @endif value="published">Aktif</option>
                    <option @if($quiz->status === 'draft') selected @endif value="draft">Hazırlanıyor</option>
                    <option @if($quiz->status === 'passive') selected @endif value="passive">Bitti</option>
                </select>
            </div>
            <div class="form-check mt-3">
                <input class="form-check-input" @if($quiz->finished_at) checked @endif type="checkbox"  id="isFinished">
                <label class="form-check-label" for="isFinished">Bitiş Tarihi Var Mı?</label>
              </div>
            <div id="finished" @if(!$quiz->finished_at)  style="display: none" @endif class="form-group mt-3">
                <label class="fw-bold" for="finished_at">Bitiş Tarihi</label>
                <input type="datetime-local" name="finished_at" class="form-control" value="{{$quiz->finished_at}}">
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-success btn-sm fs-5">Sınavı Güncelle</button>
            </div>

            </form>
        </div>
    </div>
    <x-slot name="js">
        <script>
            $('#isFinished').change(function() {
                if($('#isFinished').is(':checked')){
                    $('#finished').show();
                }
                else{
                    $('#finished').hide();
                }
            })
        </script>

    </x-slot>
</x-app-layout>
