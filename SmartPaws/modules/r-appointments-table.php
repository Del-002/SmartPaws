<?php

$date = date_create($row['Appointment_Date']);
$time = date_create($row['Appointment_Time']);

 echo '<tr>';
    echo '<td>' . date_format($date,"m/d/Y") . '</td>';
    echo '<td>' . date_format($time,"g:i A") . '</td>';
    echo '<td>' . $row['Owner_Name'] . '</td>';
    echo '<td>' . $row['Pet_Name'] . '</td>';
    echo '<td>' . $row['Reason'] . '</td>';
    echo '<td><a class="btn btn-warning btn-sm" href="R_Pet_Record.php?pet-ID=' . $row['Pet_ID'] . '&owner-ID=' . $row['Owner_ID'] . '">View</a></td>';
echo '</tr>';
?>