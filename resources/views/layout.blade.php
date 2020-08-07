<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

    <link rel="stylesheet" type="text/css" href="css/app.css">

    {{-- Styles --}}
    <style>
      #app {
        margin-top: 10px;
      }
    </style>
  </head>

  <body>
    <div id="app" class="content">
      <fibonacci-component></fibonacci-component>
    </div>

    <script src="js/app.js"></script>
  </body>
</html>
