<x-app-layout>
    <x-slot name="header">Öğretmen Seçimi</x-slot>

<div class="row">
      @foreach($ogretmenler as $item)
    <div class="col-md-2 d-flex justify-content-center">

        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="url('storage/app/public/profile-photos/'.{{$item->profile_photo_path}})">
            <div class="card-body">
                <input class="form-check-input" type="radio" name="secim" id="ogretmenId">
                <label class="form-check-label" for="secim">
                  {{$item->name}}  
                </label>
            </div>
          </div>

    </div>
  @endforeach


    <div class="col-md-4"></div>
</div>
    


</x-app-layout>
