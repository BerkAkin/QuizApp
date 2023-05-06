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
                        <td>{{$item->profile_photo_path}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
    </div>

</x-app-layout>
