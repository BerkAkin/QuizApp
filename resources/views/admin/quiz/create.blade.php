<x-app-layout>
    <x-slot name="header">Sınav Oluştur</x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{route('quizzes.store')}}" method="POST">
             @csrf
             <div class="form-group">
                <label class="fw-bold" for="title">Sınav Başlığı</label>
                <input type="text" name="title" class="form-control" required value="{{old('title')}}">
            </div>
            <div class="form-group mt-3">
                <label class="fw-bold" for="description">Sınav Açıklaması</label>
                <textarea name="description" class="form-control" rows="4" >{{old('description')}}</textarea>
            </div>


            <div class="form-group mt-3" style="display: none">
                <label class="fw-bold" for="sahip">Sınavı Oluşturan</label>
                <textarea name="sahip" class="form-control disabled" rows="4" >{{$sahip}}</textarea>
            </div>


            <div class="form-check mt-3">
                <input class="form-check-input" @if(old('finished_at'))checked @endif type="checkbox"  id="isFinished">
                <label class="form-check-label" for="isFinished">Bitiş Tarihi Var Mı?</label>
              </div>
            <div id="finished" @if(!old('finished_at'))  style="display: none" @endif class="form-group mt-3">
                <label class="fw-bold" for="finished_at">Bitiş Tarihi</label>
                <input type="datetime-local" name="finished_at" class="form-control" value="{{old('finished_at')}}">
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-success btn-sm fs-5">Sınav Yarat</button>
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
