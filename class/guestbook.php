<?php 
require_once 'message.php';
class guestbook 
{

    public function __construct(string $file)
    {
        $directory = dirname($file);
        if(!is_dir($directory))
        {
            mkdir($directory, 077,true);
        }
        if(!file_exists($file))
        {
            touch($file);
        }
        $this->file = $file;
    }

    public function addmessage(message $message): void
    {
file_put_contents($this->file, $message, FILE_APPEND);
    }

}