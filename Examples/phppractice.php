<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <table>
            <tr>
                <td></td>
            </tr>
        </table>

        <?php
            $hold = 0;
            
            echo "<table>";
            echo "<tr>";
            echo "<th>Index</th>";
            echo "<th>Number</th>";
            echo "<th>Odd/Even</th>";
            echo "<th>Running Average</th>";
            echo "</tr>";
            
            
            for ($i=1;$i<=10;$i++) {
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                $j = rand(1,100);
                if ($j % 2 == 0) {
                    echo "<td>" . $j . "</td>";
                    echo "<td>even</td>";
                } else {
                    echo "<td>" . $j . "</td>";
                    echo "<td>odd</td>";
                }
                
                $hold += $j;
                
                echo "<td>" . round($hold/$i, 2) . "</td>";
                
                echo "</tr>";
            }
            
            echo "</table><br><br>";
    
            echo "Total = " . $hold . "<br><br>";
            echo "Average = " . round($hold/9, 2);
        ?>
    </body>
</html>

