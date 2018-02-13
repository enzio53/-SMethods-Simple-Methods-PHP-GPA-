<?php
/**
 * Class SEncrypt
 *
 * (work with GPA)
 * @link https://github.com/enzio53/GPA
 */
class SEncrypt{

    private $alphabet = "123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";

    /**
     * @param $str
     * @param $secret_key
     * @param $secret_iv
     * @return string
     */
    public function sha256_encode($str, $secret_key, $secret_iv){
        $key    = hash('sha256', $secret_key);
        $iv     = substr(hash('sha256', $secret_iv), 0, 16);

        return base64_encode(openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv));
    }

    /**
     * @param $str
     * @param $secret_key
     * @param $secret_iv
     * @return string
     */
    public function sha256_decode($str, $secret_key, $secret_iv){
        $key    = hash('sha256', $secret_key);
        $iv     = substr(hash('sha256', $secret_iv), 0, 16);

        return openssl_decrypt(base64_decode($str), "AES-256-CBC", $key, 0, $iv);
    }

    /**
     * @param $str
     * @return string
     */
    public function bin_decode($str){
        return pack('H*', $str);
    }

    /**
     * @param $str
     * @return mixed
     */
    public function bin_encode($str){
        return array_shift(unpack('H*', $str));
    }

    /**
     * @param $int
     * @return string
     *
     * Encode base58 (work with only int)
     */
    public function base58_encode($int) {
        $base58_string  = "";
        $base           = strlen($this->alphabet);
        while($int >= $base) {
            $div            = floor($int / $base);
            $mod            = ($int - ($base * $div));
            $base58_string  = $this->alphabet{$mod} . $base58_string;
            $int            = $div;
        }
        if($int) $base58_string = $this->alphabet{$int} . $base58_string;

        return $base58_string;
    }

    /**
     * @param $base58
     * @return float|int
     *
     * Decode base58
     */
    public function base58_decode($base58) {
        $int_val = 0;
        for($i=strlen($base58)-1,$j=1,$base=strlen($this->alphabet);$i>=0;$i--,$j*=$base) {
            $int_val += $j * strpos($this->alphabet, $base58{$i});
        }

        return $int_val;
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