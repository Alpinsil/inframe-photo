<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

</head>

<body>

  <p>Date: <input type="text" id="datepicker"></p>


  <script>
    var unavailableDates = ["23-06-2024", "24-09-2022", "25-09-2022"];
    $(function() {
      $("#datepicker").datepicker({
        startDate: '-0m', // this for disable past days
        format: 'dd/mm/yyyy',
        todayHighlight: 'TRUE',
        autoclose: true,
        datesDisabled: unavailableDates // for disable your specific days
      });
    });
  </script>

</body>

</html>