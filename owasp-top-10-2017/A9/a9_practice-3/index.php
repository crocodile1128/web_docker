<?php
include "config.php";
class WEB{
    private $method;
    private $args;
    private $conn;
    public function __construct($method, $args) {
        $this->method = $method;
        $this->args = $args;
        $this->__conn();
    }
    function show() {
        list($username) = func_get_args();
        $sql = sprintf("SELECT * FROM users WHERE username='%s'", $username);
        $obj = $this->__query($sql);
        if ( $obj != false  ) {
            $this->__die( sprintf("%s is %s", $obj->username, $obj->role) );
        } else {
            $this->__die("Nobody Nobody But You!");
        }
        
    }
    function login() {
        global $FLAG;
        list($username, $password) = func_get_args();
        $username = strtolower(trim(mysql_escape_string($username)));
        $password = strtolower(trim(mysql_escape_string($password)));
        $sql = sprintf("SELECT * FROM users WHERE username='%s' AND password='%s'", $username, $password);
        if ( $username == 'boik' || stripos($sql, 'boik') != false ) {
            $this->__die("Boik is so shy. He do not want to see you.");
        }
        $obj = $this->__query($sql);
        if ( $obj != false && $obj->role == 'admin'  ) {
            $this->__die("Hi, Boik! Here is your flag: " . $FLAG);
        } else {
            $this->__die("Admin only!");
        }
    }
    function source() {
        highlight_file(__FILE__);
    }
    function __conn() {
        global $db_host, $db_name, $db_user, $db_pass;
        if (!$this->conn)
            $this->conn = mysql_connect($db_host, $db_user, $db_pass);
        mysql_select_db($db_name, $this->conn);
        mysql_query("SET names utf8");
        mysql_query("SET sql_mode = 'strict_all_tables'");
    }
    function __query($sql, $back=true) {
        $result = @mysql_query($sql);
        if ($back) {
            return @mysql_fetch_object($result);
        }
    }
    function __die($msg) {
        $this->__close();
        header("Content-Type: application/json");
        die( json_encode( array("msg"=> $msg) ) );
    }
    function __close() {
        mysql_close($this->conn);
    }
    function __destruct() {
        $this->__conn();
        if (in_array($this->method, array("show", "login", "source"))) {
            @call_user_func_array(array($this, $this->method), $this->args);
        } else {
            $this->__die("What do you do?");
        }
        $this->__close();
    }
    function __wakeup() {
        foreach($this->args as $k => $v) {
            $this->args[$k] = strtolower(trim(mysql_escape_string($v)));
        }
    }
}
if(isset($_GET["data"])) {
    @unserialize($_GET["data"]);    
} else {
    new WEB("source", array());
}
