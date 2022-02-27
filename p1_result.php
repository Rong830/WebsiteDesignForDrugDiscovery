<?php




$db_server = mysql_connect( $db_hostname, $db_username, $db_password );
if ( !$db_server )die( "Unable to connect to database: " . mysql_error() );
mysql_select_db( $db_database, $db_server )or die( "Unable to select database: " . mysql_error() );

echo <<<_TABLE1
<div class="table-wrapper" align="bottom">
    <table class="fl-table">
        <thead>
        <tr>
            <th> id </th>
            <th>natm</th>
            <th>ncar</th>
            <th>nnit</th>
            <th>noxy</th>
            <th>nsul</th>
            <th>ncycl</th>
            <th>nhdon </th>
            <th>nhacc</th>
            <th>nrotb</th>
            <th>ManuID</th>
            <th>catn</th>
            <th>mw</th>
            <th>TPSA</th>
            <th>XLogP</th>
        </tr>
        </thead>
        <tbody>
_TABLE1;

for($j = 0 ; $j < sizeof($suppliers) ; ++$j)
{
    if ($suppliers[$j]) {
        $query = sprintf( "SELECT * FROM Compounds WHERE ManuID=$suppliers[$j]" );
        $result = mysql_query( $query );
        $row = mysql_fetch_row( $result );
        echo "<tr>";
        echo "<td>";
        echo $snm[$j];
        echo "</td>";
        echo '<td>' .round($row[ 0 ], 4) . '</td>';
        echo '<td>' .round($row[ 1 ], 4) . '</td>';
        echo '<td>' .round($row[ 2 ], 4) . '</td>';
        echo '<td>' .round($row[ 3 ], 4) . '</td>';
        echo '<td>' .round($row[ 4 ], 4) . '</td>';
        echo '<td>' .round($row[ 5 ], 4) . '</td>';
        echo '<td>' .round($row[ 6 ], 4) . '</td>';
        echo '<td>' .round($row[ 7 ], 4) . '</td>';
        echo '<td>' .round($row[ 8 ], 4) . '</td>';
        echo '<td>' .round($row[ 9 ], 4) . '</td>';
        echo '<td>' .round($row[ 10 ], 4) . '</td>';
        echo '<td>' .round($row[ 11 ], 4) . '</td>';
        echo '<td>' .round($row[ 12 ], 4) . '</td>';
        echo '<td>' .round($row[ 13 ], 4) . '</td>';
        echo '<td>' .round($row[ 14 ], 4) . '</td>';
        echo "</tr>"; 
    }
}

echo "</tr> <tbody> </table> </div>";



?>