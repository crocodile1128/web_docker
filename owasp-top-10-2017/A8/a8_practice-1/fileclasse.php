<?php
class FileClass {
    public $filename = 'error.log';
    public $content = '';

    public function __construct($content) {
        $this->content = $content;
    }

    public function __toString() {
        return file_get_contents($this->filename);
    }

    public function __wakeup() {
        if(preg_match('/\</',$this->content)){
            die('hack');
        }
        $dir = 'sandbox/' . $_SERVER['REMOTE_ADDR'];
        if ( !file_exists($dir) )
            mkdir($dir);
        chdir($dir);
        if (!preg_match('/^\w+$/', $this->filename)) die("Invalid filename!");
        file_put_contents($this->filename . ".php", $this->content);
    }
}
?>
