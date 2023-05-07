<x-app-layout>
    <x-slot name="header">Öğretmen Seçimi</x-slot>
<form action="{{route('ogretmen.store')}}" method="POST">
    @csrf


    <div class="row">
        <div class="col-12">
            @foreach($ogretmenler as $item)
                @if($item->id == auth()->user()->ogretmen_id)
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        @if($item->profile_photo_path)
                        <img class="card-img" src="{{asset('storage/')}}/{{$item->profile_photo_path}}">
                    @endif
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                            <h5 style="letter-spacing: 3px">Mevcut Öğretmen</h5>
                          <p class="card-text text-muted mt-4">{{$item->name}}</p>
                          <p class="card-text text-muted">{{$item->email}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                    @break
                @endif
            @endforeach  
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
                <button id="onaybuton" style="display: none" type="submit" class="btn btn-sm btn-dark float-right shadow-none">Seçimi Kaydet</button>
                <div class="form-check mt-1">
                    <input class="form-check-input bg-dark border-1 border-dark" style="box-shadow:none !important; transform:scale(1.2)" type="checkbox" id="ogrDegisimIstek">
                    <label class="form-check-label text-sm fw-bold" for="flexCheckDefault" >Öğretmen Değiştirmek İstiyorum</label>
                </div>
        </div>
    </div>

    <div style="display: none" id="panel" class="row mt-2"> 
        <hr>
        <input name="ogrenci_id" type="text" value="{{auth()->user()->id}}" class="d-none">
        @foreach($ogretmenler as $item)
            @if($item->id == auth()->user()->ogretmen_id)
            @else
            
                <div class="col-md-2 d-flex mt-3 justify-content-center">
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
                    
            @endif

        @endforeach
    </div>
</form>

<x-slot name="js">

    <script>
        $('#ogrDegisimIstek').change(function() {
            if($('#ogrDegisimIstek').is(':checked')){
                $('#panel').show();
                $('#onaybuton').show();
            }
            else{
                $('#panel').hide();
                $('#onaybuton').hide();
            }
        })
    </script>

</x-slot> 


</x-app-layout>
