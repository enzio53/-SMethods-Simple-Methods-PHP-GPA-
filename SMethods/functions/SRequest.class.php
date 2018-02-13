<?php
/**
 * Class SRequest
 *
 * (work with GPA)
 * @link https://github.com/enzio53/GPA
 */
class SRequest{

    private $storage;

    public function __construct($storage = null){
        if($storage){
            $this->storage = true;
        } else {
            $this->storage = false;
        }


    }

    public function Get($api_endpoint){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $api_endpoint
        ));

        $value = curl_exec($curl);
        curl_close($curl);

        $this->Store($api_endpoint, $value);
        return $value;
    }

    public function Post($api_endpoint, $header){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $api_endpoint,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $header
        ));

        $value = curl_exec($curl);
        curl_close($curl);

        $this->Store($api_endpoint, $value);
        return $value;
    }

    private function Store($api_endpoint, $data){
        if($this->storage){
            $handle = fopen('storage/SRequest-'.(mt_rand(1, 100) * 493 * 3).'-store.txt', 'a+');
            fwrite($handle, "API ENDPOINT : ".$api_endpoint."\n\nDATA RESULT : ".$data);
            fclose($handle);
        }
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