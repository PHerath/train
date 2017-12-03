<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Additional Train</title>
    </head>
    <body>
        <table align="center">
            <tr>
                 <th> <table border=solid>
                    <!-- Table coloumn names -->
                    <tr>
                        <!-- Earray for keep express train details and Narray for keep Normal train details -->
                     <?php $Earray=$new[0]; $Narray=$new[1];?>
                    <!-- getting values from returened array from controller -->
                    <th><?php echo $Earray['start']; ?></th>
                    <th><?php echo $Earray['end']; ?></th>
                    <th>Duration</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Availability</th>
                    </tr>

                    <!-- get the keys of new array to remove the first three entrees -->
                    <?php $key = array_keys($Earray);
                    //print_r($key);
                        // craete new array
                        $keynew = array_slice($key,3,count($key)-1);
                        //print_r($keynew);
                    ?>
                    <!-- get the key value and use it to get the values from main array -->
                    <!-- Use alternative php syntax -->
                    <?php foreach($keynew as $key1): ?>
                        <?php $row = $Earray[$key1];?>
                        <tr>
                        <!-- getting values and replace with : and needed other string parts -->
                        <th><?php echo substr_replace($row[$Earray['start']], ':', -2, 0)."h"; ?></th>
                        <th><?php echo substr_replace($row[$Earray['end']], ':', -2, 0)."h"; ?></th>
                        <!-- Converting the difference to 12 hours mode and print it out -->
                        <th><?php $y=intdiv(abs($row[$Earray['end']]-$row[$Earray['start']]),100);
                            $x=abs($row[$Earray['end']]-$row[$Earray['start']])%100;
                            $x=60-(100-$x);
                            $y=$y*100+$x;
                            if($y<100){
                            $y="00".$y;}
                            echo substr_replace($y, ' hours and ', -2, 0)." minitues"; ?></th>
                        <!-- Getting other values from array-->
                        <th><?php echo $row['Name']; ?></th>
                        <th><?php echo $row['Type']; ?></th>
                        <th><?php echo $row['Availability']; ?></th>
                        </tr>
                    <?php endforeach; ?>

                </table></th>
            <th> <table border=solid>
            <!-- Table coloumn names -->
                    <tr>
                    <!-- getting values from returened array from controller -->
                    <th><?php echo $Narray['start']; ?></th>
                    <th><?php echo $Narray['end']; ?></th>
                    <th>Duration</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Availability</th>
                    </tr>

                    <!-- get the keys of new array to remove the first three entrees -->
                    <?php $key = array_keys($Narray);
                        // craete new array
                        $keynew = array_slice($key,3,count($key)-1);
                    ?>
                    <!-- get the key value and use it to get the values from main array -->
                    <!-- Use alternative php syntax -->
                    <?php foreach($keynew as $key1): ?>
                        <?php $row = $Narray[$key1];?>
                        <tr>
                        <!-- getting values and replace with : and needed other string parts -->
                        <th><?php echo substr_replace($row[$Narray['start']], ':', -2, 0)."h"; ?></th>
                        <th><?php echo substr_replace($row[$Narray['end']], ':', -2, 0)."h"; ?></th>
                        <!-- Converting the difference to 12 hours mode and print it out -->
                        <th><?php $y=intdiv(abs($row[$Narray['end']]-$row[$Narray['start']]),100);
                            $x=abs($row[$Narray['end']]-$row[$Narray['start']])%100;
                            $x=60-(100-$x);
                            $y=$y*100+$x;
                            if($y<100){
                            $y="00".$y;}
                            echo substr_replace($y, ' hours and ', -2, 0)." minitues"; ?></th>
                        <!-- Getting other values from array-->
                        <th><?php echo $row['Name']; ?></th>
                        <th><?php echo $row['Type']; ?></th>
                        <th><?php echo $row['Availability']; ?></th>
                        </tr>
                    <?php endforeach; ?>

        </table></th>
            </tr>
        </table>
    </body>
</html>

