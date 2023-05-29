<x-app-layout>
    <x-slot name="header">Sistem Logları</x-slot>




    <div class="d-flex align-items-start ">

        <div class="flex-column me-3" id="v-pills-tab"  aria-orientation="vertical">
          <a href="{{ route('loglar.tum','dashboard') }}" class="btn btn-warning mt-3 fw-bold btn-lg d-block" style="width:8rem;">Dashboard</a>
          <a href="{{ route('loglar.tum','mesajlar') }}" class="btn btn-success mt-3 fw-bold btn-lg d-block d-block" style="width:8rem;">Mesajlar</a>
          <a href="{{ route('loglar.tum','sinavlar') }}" class="btn btn-danger mt-3 fw-bold btn-lg d-block" style="width:8rem;">Sınavlar</a>
          <a href="{{ route('loglar.tum','notlar') }}" class="btn btn-danger mt-3 fw-bold btn-lg d-block" style="width:8rem;">Notlar</a>
          <a href="{{ route('loglar.tum','kayitlar') }}" class="btn btn-info mt-3 fw-bold btn-lg d-block" style="width:8rem;">Kayıt</a>
          <a href="{{ route('loglar.tum','ogrKabul') }}" class="btn btn-info mt-3 fw-bold btn-lg d-block" style="width:8rem;">Öğr Onay</a>
          <a href="{{ route('loglar.tum','ogrSilme') }}" class="btn btn-info mt-3 fw-bold btn-lg d-block" style="width:8rem;">Öğr Silme</a>
          <a href="{{ route('loglar.tum','sinavGirilme') }}" class="btn btn-primary mt-3 fw-bold btn-lg d-block" style="width:8rem;">Sınav Gir</a>
          <a href="{{ route('loglar.tum','tipDegistir') }}" class="btn btn-dark mt-3 fw-bold btn-lg d-block" style="width:8rem;">Tipler</a>
        </div>

        <div class="tab-content mt-3 w-100">
            {{-- sınavlar tab --}}
          <div class="ms-1">
            {{-- tek bir tablo --}}
            <div class=" rounded"  style="overflow: auto; height:700px"> 
                <table id="notlarTab" class="table table-bordered table-striped table-hover">
                    <thead class="table-dark" style="position: sticky;top: 0">
                      <tr class="text-center">
                        <th scope="col">İşlem</th>
                        <th scope="col">Gerçekleştiren</th>
                        <th scope="col">İşlem Tarihi</th>
                        <th scope="col">IP Adresi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @isset($log)
                        @foreach($log as $item)
                          <tr class="text-center">
                            <td>{{$item->Islem}}</td>
                            <td>{{$item->islemiYapan}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->IpAdresi}}</td>
                          </tr>
                        @endforeach
                      @endisset
                    </tbody>
                  </table>
            </div>
          </div>
        </div>

    </div>



<x-slot name="js">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</x-slot> 


</x-app-layout>
