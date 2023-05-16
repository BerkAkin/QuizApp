<x-app-layout>
    <x-slot name="header">Öğrenci Notları</x-slot>
    
{{--     <select onchange="myFunction(this)" name="filt" class="form-select" aria-label="Default select example">   
        <option value="0">Sonuçları Filtrele...</option>
        @foreach($sinavlar as $item)
            <option value="{{$item->id}}">{{$item->title}}</option>
        @endforeach
    </select> --}}   
    <input style="box-shadow:none !important;" class="form-input border-secondary" name="filt" type="text" id="filtre" onkeyup="myFunction()" placeholder="Sınav İsmiyle Ara">
    <input style="box-shadow:none !important;" class="form-input border-secondary ms-2" name="filt2" type="text" id="filtre2" onkeyup="myFunction2()" placeholder="Öğrenci İsmiyle Ara">
 
<div class="mt-3 rounded border" style="overflow: auto; height:700px"> 
   <table id="notlarTab" class="table table-bordered table-striped table-hover border-secondary">
     <thead class="table-dark" style="position: sticky;top: 0">
       <tr>
         <th scope="col">Sınav</th>
         <th scope="col">Öğrenci Adı Soyadı</th>
         <th scope="col">Öğrenci Mail</th>
         <th class="text-center" scope="col">Puan</th>
         <th class="text-center" scope="col">Doğru/Yanlış</th>
       </tr>
     </thead>
     <tbody>
        @foreach($notlar as $items)
       <tr>
         <td>{{$items->title}}</td>
         <td>{{$items->name}}</td>
         <td>{{$items->email}}</td>
         <td class="text-center @if($items->gereken_min_not>$items->score)bg-danger text-light @else bg-success text-light @endif">{{$items->score}}</td>
         <td class="text-center">{{$items->correct}} / {{$items->wrong}}</td>

       </tr>
       @endforeach
     </tbody>
   </table>
</div>


<x-slot name="js">
        <script>
            function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("filtre");
            filter = input.value.toUpperCase();
            table = document.getElementById("notlarTab");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
            }

            function myFunction2() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("filtre2");
            filter = input.value.toUpperCase();
            table = document.getElementById("notlarTab");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
            }
        </script>

    </x-slot>

    
    <x-slot name="footer">

    </x-slot>
</x-app-layout>
