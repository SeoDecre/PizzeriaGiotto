<?php

    //$_SESSION['connection']
    ?>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style/main.css">
        <title>Pizza order </title>
    </head>

    <body>

    <div class="pizza-menu-container">
        <?php
        $connection=$_SESSION['connection'];
        $counter=0;
        while ($row=$connection->fetch_row()){
            // width e height sono temporanei nel tag 'img'
            // aggiungere i metodi 'removeOne()' e 'addOne()' nel file js
            

            echo "<div class=\"pizza-menu-element\">

                   <img class=\"pizza-menu-img\" src=\"$row[4]\" alt=\"$row[2]\" width=\"500\" height=\"600\"> 
                        <div class=\"pizza-menu-info\">
                            <p>$row[1]</p>
                            <p>$row[2]</p>
                            <p>$row[3]€</p>
                            <div class=\"pizza-menu-buttons\">
                            <input id=\"$counter.add\" type=\"button\" value=\"Remove one\" onclick=\"removeOne(this.id);\"/>
                            <input id=\"$counter.rem\" type=\"button\" value=\"Add one\" onclick=\"addOne(this.id);\"/>
                            </div>
                          
                        </div>
                   </div>
                 ";

            // da finire

            $counter++;
                }


       //
       // </div>

        ?>
    </div>
    <script>
        //initialize pizza counter
        createVar();
    </script>

    </body>
    </html>
