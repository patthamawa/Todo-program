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
          <form action="{{ route('search') }}" method="GET" style="width:650px">
            <div class="input-group mb-3">
              <input type="text" class="form-control"  name="search" placeholder="คุณต้องการค้นหาอะไร">
              <div class="input-group-append">
                <button class="btn btn-dark" type="submit">ค้นหา</button>
              </div>
            </div>
            {{-- <input type="text" name="search" required/>
            <button type="submit">ค้นหา</button> --}}
          </form>
      <a href="/create" class="btn btn-primary my-1">เพิ่ม</a>  
        </div>
        {!! $todoTable !!}
        <center><br>
        <p>@create by</p>
        <p>นางสาวปัทมา วามะกัน 65114340523</p>
        <p>นางสาวศุภลักษณ์ รสจันทร์ 65114340772</p>
        </center>
      </div>
    </body>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
      "use strict";
      $(document).ready(function() {
      })

    </script>
</html>