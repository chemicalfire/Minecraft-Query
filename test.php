<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Minecraft Query Test</title>
    </head>
    <body>
        <?php
        
        require_once("minecraftquery.class.php");
        
            $query = MinecraftQuery::query("future-popcan.com");
            
            
            
            print($query["description"] . "<br />");
            print($query["players"] . "<br />");
            print($query["maxplayers"] . "<br />");
            
        ?>
    </body>
</html>
