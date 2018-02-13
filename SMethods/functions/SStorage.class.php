<?php
/**
 * Class SStorage
 *
 * (work with GPA)
 * @link https://github.com/enzio53/GPA
 */
class SStorage{

    public function NewFile($name, $data){
        $handle = fopen('SStorage/'.$name, 'a+');
        fwrite($handle, $data);
        fclose($handle);

        return true;
    }

    public function ReadFile($name){
        $handle = fopen('SStorage/'.$name, 'r');
        $result = fread($handle, filesize('SStorage/'.$name));
        fclose($handle);

        return $result;
    }

    public function NewFileEncrypt($name, $data){
        $handle = fopen('SStorage/encrypted-'.$name, 'a+');
        fwrite($handle, $this->encode($data));
        fclose($handle);

        return true;
    }

    public function ReadFileEncrypt($name){
        $handle = fopen('SStorage/encrypted-'.$name, 'r');
        $result = fread($handle, filesize('SStorage/'.$name));
        fclose($handle);

        return $this->decode($result);
    }

    private function decode($str){
        return pack('H*', $str);
    }

    private function encode($str){
        return array_shift(unpack('H*', $str));
    }

}

/**
 *
 * SMethods (work with GPA)
 * @author Enzo Poker <enzio@garryhost.com>
 * @link https://github.com/enzio53/GPA
 * @version 1.0
 *
 */