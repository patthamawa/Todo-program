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
    @foreach($todoList as $key => $task)
    <tr>
        <th scope="row">{{ $key+1 }}</th>
        <td>{{ $task["title"] }}</td>
        <td>{{ $task["description"] }}</td>
        <td>{{ DateThai(date('d-M-Y ', strtotime($task["due_date"]))); }}</td>
        <td class="{{ ($task["status"]==1) ? 'text-success' : 'text-danger' }}"> {{ ($task["status"] == 1)? 'เรียบร้อย' : 'รอการแก้ไข'}}</td>
        <td>
            <a href="/done/{{ $task['id'] }}" class="btn btn-success mx-1">เรียบร้อย</a>
            <a href="/edit/{{ $task['id'] }}" class="btn btn-outline-secondary mx-1">แก้ไข</a>
            <a href="#" id="cf-delete" onclick="cfDelete({{ $task['id'] }});" class="btn btn-outline-danger mx-1 deleteBtn ">ลบ</a>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>

<script>
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