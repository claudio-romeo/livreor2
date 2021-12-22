<?php 
require_once 'message.php';
class guestbook 
{

    public function __construct(string $file)
    {
        $directory = dirname($file);
        if(!is_dir($directory))
        {
            mkdir($directory, 0777,true);
        }
        if(!file_exists($file))
        {
            touch($file);
        }
        $this->file = $file;
    }

    public function addmessage(Message $message): void
    {
        file_put_contents($this->file, $message->toJSON() . PHP_EOL ,  FILE_APPEND);
    }


    public function getMessages(): array
    {
        $content = trim(file_get_contents($this->file));
        $lines = explode(PHP_EOL, $content);
         $messages = [];
        foreach($lines as $line)
        {
            $data = json_decode($lines,true);
            $messages[] = new message($data['username'],$data['message'], new DateTime("@" . $data['date'])) ;
        }
       var_dump($messages);
    }

}