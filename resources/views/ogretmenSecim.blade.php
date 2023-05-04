<x-app-layout>
    <x-slot name="header">Öğretmen Seçimi</x-slot>
<form action="{{route('ogretmen.store')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="float-right">
                <button type="submit" class="btn btn-md btn-dark">Seçimi Kaydet</button>
            </h5>
        </div>
    </div>
    <div class="row mt-3"> 
        <input name="ogrenci_id" type="text" value="{{auth()->user()->id}}" class="d-none">
        @foreach($ogretmenler as $item)
            <div class="col-md-2 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    @if($item->profile_photo_path)
                        <img class="card-img-top" src="{{asset('storage/')}}/{{$item->profile_photo_path}}">
                    @endif
                    <div class="card-body text-center">
                        <input class="form-check-input" type="radio" name="ogretmen_id" id="{{$item->id}}" value="{{$item->id}}">
                        <label class="form-check-label" for="secim">
                        {{$item->name}}  
                        </label>
                       
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</form>
    


</x-app-layout>
