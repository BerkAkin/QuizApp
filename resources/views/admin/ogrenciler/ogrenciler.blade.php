<x-app-layout>
    <x-slot name="header">Mevcut Öğrenciler</x-slot>




        <div class="row"> 
            @foreach ($ogrencilerim as $item)
            <div class="col-md-2 d-flex mt-3 justify-content-center">
                <div class="card" style="width: 18rem;">
                    @if($item->profile_photo_path)
                        <img class="card-img-top" src="{{asset('storage/')}}/{{$item->profile_photo_path}}">
                    @endif
                    <div class="card-body text-center">
                        <label class="form-check-label" for="secim">{{$item->name}}</label>
                        <label class="form-check-label text-muted text-sm text-wrap w-75">{{$item->email}}</label>
                        <form action="{{route('ogrenciler.update',$item->id)}}" method="POST">
                            @csrf 
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger btn-block w-100 mt-3"><i class="fa fa-times me-2"></i>Sil</button>
                        </form>
                    
                    </div>
                </div>
            </div>               

                
            @endforeach
        </div>


</x-app-layout>
