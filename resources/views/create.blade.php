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
  <link rel="stylesheet" href="{{ asset('css/normalize.css'); }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css'); }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
  <style>
    body {
      font-family: 'IBM Plex Sans Thai', sans-serif;
    }
  </style>
</head>

<body class="antialiased" style="background-color:linen;">
  <div class="container">
    <form id="createTaskForm" action="#" method="post" >
      <div class="form-group mt-5">
        <label for="title" ><h4>ชื่องาน</h4></label>
        <input type="text" class="form-control" id="title" placeholder="ใส่ชื่องาน">
      </div>
      <div class="form-group">
        <label for="description"><h4>รายละเอียด</h4></label>
        <textarea class="form-control" id="description" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="dueDate"><h4>วัน/เดือน/ปี</h4></label>
        <input type="text" class="datepicker date form-control" id="dueDate" aria-describedby="dueDateHelp" placeholder="ปฏิทิน"/>
        <small id="dueDateHelp" class="form-text text-muted">รูปแบบวันที่คือ 2022-09-20</small>
      </div>
      <div class="form-group">
        <label for="title"><h4>สถานะงาน</h4></label>
        <select class="form-control" id="status">
          <option value="1">เรียบร้อย</option>
          <option value="0">รอการแก้ไข</option>
        </select>
      </div>
      <center><button type="submit" class="btn btn-success mt-2 mr-5">ยืนยัน</button>
      <a href="/" class="btn btn-danger mt-2">ยกเลิก</a>
    </form>
  </div>
</body>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  $(".date").datepicker({
      format: "yyyy-mm-dd",
    });
</script>

<script type="text/javascript">
  "use strict";
    $(document).ready(function() {
      $('#createTaskForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
          url:'/',
          type: "POST",
          data: {
            "_token": "{{ csrf_token() }}",
            title: $('#createTaskForm').find('#title').val(),
            description: $('#createTaskForm').find('#description').val(),
            due_date: $('#createTaskForm').find('#dueDate').val(),
            status: $('#createTaskForm').find('#status').val()
          },
          success:function(response){
            alert('คุณต้องการเพิ่มงานใช่หรือไม่.')
            window.location = "/"
          }
        })
      })
    })
</script>

</html>