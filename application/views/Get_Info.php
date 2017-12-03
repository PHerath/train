<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Train Search</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="assets/js/highlight.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script>
            $( function() {
              $("#datepicker").datepicker({
                dateFormat: "DD, MM d, yy",
                showOtherMonths: false,
                selectOtherMonths: true,
                }).datepicker("setDate", new Date());
            } );
        </script>

    </head>
    <body>
       <form class="form-group" method="POST" action="http://localhost/Train/index.php/Train_Search/test" >
            <div class="form-group">
                <label class="control-label col-sm-1">Start</label>
                <div class="col-sm-11">
                    <input class="form-control" type="text" name="start" required="" placeholder="Enter Start">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-1">End</label>
                <div class="col-sm-11">
                    <input class="form-control" type="text" name="end" required="" placeholder="Enter Destination">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-1">Date</label>
                <div class="col-sm-11">
                    <input class="form-control" type="text" id="datepicker" name="datepicker" required="" placeholder="Select Date">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-1">Time</label>
                <div class="col-sm-11">
                    <input class="form-control" type="text" name="time" required="" placeholder="Select time">
                </div>
            </div>

            <div class="col-sm-1">
            </div>
            <div class="col-sm-2"><input type="submit" class="btn btn-primary" value="Get Trains"></div>
        </form>

    
    </body>
</html>

