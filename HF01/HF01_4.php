<html lang="en">
    <head>
        <title></title>
        <style>
            table, td {
                border: 1px solid black;
            }


            td {
                padding: 50px;
            }

            tr:nth-child(even) td:nth-child(odd) {
                background-color: black;
            }

            tr:nth-child(odd) td:nth-child(even) {
                background-color: black;
            }
        </style>
    </head>

    <body>
    <?php
    echo <<<END
        <table>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>            
        </table>
    END;
    ?>
    </body>
</html>

