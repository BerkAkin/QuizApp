<x-app-layout>
    <x-slot name="header">Öğrenci Kabul</x-slot>
    
    <div class="card">
        <div class="card-body">
        </div>
            <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Öğrenci Ad</th>
                    <th scope="col">Öğrenci Mail</th>
                    <th scope="col">ID</th>
                    <th scope="col">Öğrenci ID</th>
                    <th scope="col">İşlemler</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach ($onaylar as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->id}}</td>
                        <td>{{$item->ogrenci_id}}</td>
                        <td class="d-flex justify-content-evenly">
                            <form action="{{route('ogrenciKabul.destroy',$item->id)}}" method="POST">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                            </form>
                            <form action="{{route('ogrenciKabul.update',$item->id)}}" method="POST">
                                @csrf 
                                @method('UPDATE')
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
    </div>

</x-app-layout>
