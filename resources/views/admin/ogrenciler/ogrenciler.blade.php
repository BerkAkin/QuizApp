<x-app-layout>
    <x-slot name="header">Mevcut Öğrenciler</x-slot>
    
    <div class="card">
        <div class="card-body">
        </div>
            <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Öğrenci Fotoğraf</th>
                    <th scope="col">Öğrenci Ad</th>
                    <th scope="col">Öğrenci Mail</th>
                    <th scope="col">İşlemler</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($ogrencilerim as $item)
                    <tr>
                        <td>
                            @if($item->profile_photo_path)
                                <img  class="card-img-top w-25" src="{{asset('storage/')}}/{{$item->profile_photo_path}}">
                            @endif
                        </td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>
                            <form action="{{route('ogrenciler.update',$item->id)}}" method="POST">
                                @csrf 
                                @method('PATCH')
                                <button type="submit" class="btn btn-dark btn-block w-100"><i class="fa fa-times me-2"></i>Sil</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
    </div>

</x-app-layout>
