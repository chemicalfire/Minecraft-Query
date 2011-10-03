<?php
/**
 * Used for the native methods of getting the description, 
 * playercount, from minecraft (1.8+)
 *
 * @author Andre Meyer
 */
class MinecraftQuery {
    static $socket;
    static $server;
    
    public static function query($address, $port=25565, $timout=30) {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        
        $server = socket_connect($socket, $address, $port);
        
        if(!$server) {
            return false; // Connection Refused.
        }
        
        $package = "\xfe";
        
        $success = socket_write($socket, $package);
        
        if(!$success) {
            return false; // Failed to write to socket.
        }
        
        $recv = socket_read($socket, '120'); 
        
        $recv = str_split($recv, 1);
                
        $tmp = "";
        foreach($recv as $r) {
            if($r != "\x00") { // Incredible Stupid Function to remove all \x00's, since you can't trim them off.
                $tmp .= $r;
            }
        }
        $recv = $tmp;
        
        $recv = substr($recv, 2); // Remove first, 2, chars. They're junk.
        $recv = explode("\xa7", $recv); // xA7 is a seperator. 
        
        
        $response["description"] = $recv[0];
        $response["players"] = $recv[1];
        $response["maxplayers"] = $recv[2];
        
        return $response;
    }
}
?>
