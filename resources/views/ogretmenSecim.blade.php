<x-app-layout>
    <x-slot name="header">Öğretmen Seçimi</x-slot>

    <div class="row ">
        <div class="col-12">
            <h5 class="float-right">
                <a href="" class="btn btn-md btn-dark">Seçimi Kaydet</a>
            </h5>
        </div>
    </div>
    <div class="row mt-3">
        @foreach($ogretmenler as $item)
            <div class="col-md-2 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    @if($item->profile_photo_path)
                        <img class="card-img-top" src="{{asset('storage/')}}/{{$item->profile_photo_path}}">
                    @endif
                    <div class="card-body text-center">
                        <input class="form-check-input" type="radio" name="secim" id="ogretmenId">
                        <label class="form-check-label" for="secim">
                        {{$item->name}}  
                        </label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    


</x-app-layout>
