<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Train</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <!-- Creating a table -->
        <table class="table table-responsive-md table-hover">
            <!-- Table coloumn names -->
            <thead>
            <tr class="table-primary">
            <!-- getting values from returened array from controller -->
            <th><?php echo $new['start']; ?></th>
            <th><?php echo $new['end']; ?></th>
            <th>Duration</th>
            <th>Name</th>
            <th>Type</th>
            <th>Availability</th>
            </tr>
            </thead>
            <!-- get the keys of new array to remove the first three entrees -->
            <?php $key = array_keys($new);
                // craete new array
                $keynew = array_slice($key,3,count($key)-1);
            ?>
            <!-- get the key value and use it to get the values from main array -->
            <!-- Use alternative php syntax -->
            <?php foreach($keynew as $key1): ?>
                <?php $row = $new[$key1];?>
                <tbody>
                <tr>
                <!-- getting values and replace with : and needed other string parts -->
                <th><?php echo substr_replace($row[$new['start']], ':', -2, 0)."h"; ?></th>
                <th><?php echo substr_replace($row[$new['end']], ':', -2, 0)."h"; ?></th>
                <!-- Converting the difference to 12 hours mode and print it out -->
                <th><?php $y=intdiv(abs($row[$new['end']]-$row[$new['start']]),100);
                    $x=abs($row[$new['end']]-$row[$new['start']])%100;
                    $x=60-(100-$x);
                    $y=$y*100+$x;
                    if($y<100){
                    $y="00".$y;}
                    echo substr_replace($y, ' hours and ', -2, 0)." minitues"; ?></th>
                <!-- Getting other values from array-->
                <th><?php echo $row['Name']; ?></th>
                <th><?php echo $row['Type']; ?></th>
                <th><?php echo $row['Availability']; ?></th>
                </tr></tbody>
            <?php endforeach; ?>

        </table>
    </body>
</html>


