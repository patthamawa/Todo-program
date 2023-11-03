@php
function DateThai($day)
{
  $Year = date("Y",strtotime($day))+543;
  $Month= date("n",strtotime($day));
  $Day= date("j",strtotime($day));
  $MonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $MonthThai=$MonthCut[$Month];
  return "$Day $MonthThai $Year";
}
@endphp


 <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>App_Todo List</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/normalize.css'); }}" >
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css'); }}" >
        <style>
            body { font-family: 'IBM Plex Sans Thai', sans-serif; }
        </style>
    </head>
    <body class="antialiased" style="background-color:linen;">
      <div class="container mt-5">
        <div class="">
          <a href="/" class="btn btn-secondary btn-sm my-1">กลับไปหน้าแรก</a><p>
          
          
          <form action="{{ route('search') }}" method="GET" style="width:650px">

            <div class="input-group mb-3">
              <input type="text" class="form-control"  name="search" placeholder="คุณต้องการค้นหาอะไร">
              <div class="input-group-append ">
                <button class="btn btn-dark" type="submit">ค้นหา</button>
              </div>
            </div>
            {{-- <input type="text" name="search" required/>
            <button type="submit">ค้นหา</button> --}}
            <a href="/create" class="btn btn-primary my-1 mr-2">เพิ่มงานใหม่</a>
          </form>
        </div>
        
        <table class="table" id="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col" onclick="sortTable(0)">ชื่องาน</th>
                <th scope="col" onclick="sortTable(1)">รายละเอียด</th>
                <th scope="col" onclick="sortTable(2)">วัน/เดือน/ปี</th>
                <th scope="col" onclick="sortTable(3)">สถานะงาน</th>
                <th scope="col" onclick="sortTable(4)"> </th>
              </tr>
            </thead>
            <tbody>


                @if($searchs->isNotEmpty())
                    @foreach ($searchs as $key => $search)
                    <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td>{{ $search["title"] }}</td>
                        <td>{{ $search["description"] }}</td>
                        <td>{{ DateThai(date('d-M-Y ', strtotime($search["due_date"]))); }}</td>
                        <td class="{{ ($search["status"]==1) ? 'text-success' : 'text-danger' }}"> {{ ($search["status"] == 1)? 'เรียบร้อย' : 'รอการแก้ไข'}}</td>
                        <td>
                            <a href="/done/{{ $search['id'] }}" class="btn btn-success mx-1">เรียบร้อย</a>
                            <a href="/edit/{{ $search['id'] }}" class="btn btn-outline-secondary mx-1">แก้ไข</a>
                            <a href="#" id="cf-delete" onclick="cfDelete({{ $search['id'] }});" class="btn btn-outline-danger mx-1 deleteBtn ">ลบ</a>
                        </td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <th></th>
                        <td></td>
                    <td><H2 class="text-center"><br>ไม่พบข้อมูล</H2></td>
                        <td></td>
                        <td></td>
                        
                    </tr>
                @endif
            </tbody>
            </table>

      </div>
    </body>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
            function cfDelete($id){
                if (confirm("คุณต้องการลบใช่หรือไม่!") == true) {
                $.ajax({
                        url:'/delete/'+$id,
                        type: "GET",
                        data: {
                        "_token": "{{ csrf_token() }}"
                        },
                        success:function(response){
                        alert('ลบแล้ว')
                        window.location = "/"
                        }
                })
                }
            }
    </script>
</html>

<script>
  function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("table");
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
      // Start by saying: no switching is done:
      switching = false;
      rows = table.rows;
      /* Loop through all table rows (except the
      first, which contains table headers): */
      for (i = 1; i < (rows.length - 1); i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
        /* Get the two elements you want to compare,
        one from current row and one from the next: */
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        /* Check if the two rows should switch place,
        based on the direction, asc or desc: */
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark that a switch has been done: */
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        // Each time a switch is done, increase this count by 1:
        switchcount ++;
      } else {
        /* If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again. */
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }
  </script>