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
      .mx-datepicker {
        position: inherit !important;
        display: inherit !important;
        width: 100% !important;
      }
      .mx-input-wrapper {
        width: 100% !important;
      }
      .mx-icon-calendar {
        display: none;
      }
      .action-buttons {
        margin-top: 15px;
      }
      .clear-btn {
        margin-left: 10px;
      }
      #fibonacci, #sort, #employee {
        margin-bottom: 20px;
      }
    </style>
  </head>

  <body>
    <div id="app" class="content">
      <fibonacci-component></fibonacci-component>
      <sort-component></sort-component>
      <employee-template></employee-template>
    </div>

    <script src="js/app.js"></script>
  </body>
</html>
