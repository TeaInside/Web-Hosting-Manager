<?php

if (! function_exists("rstr")) {
	/**
	 * @param int 	 $n
	 * @param string $e
	 * @return string
	 */
	function rstr($n = 32, $e = null)
	{
		if (! is_string($e)) {
			$e = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890___";
		}
		$rn = "";
		$ln = strlen($e) - 1;
		for ($i=0; $i < $n; $i++) { 
			$rn .= $e[rand(0, $ln)];
		}
		return $rn;
	}
}

if (! function_exists("encrypt")) {
    /**
     * @param string    $str
     * @param string    $key
     * @param bool      $binarySafe
     * @return string
     */
    function encrypt($str, $key, $binarySafe = true)
    {
        $key = (string) $key;
        $salt = makeSalt();
        $key  = sha1($key.$salt);
        $klen = strlen($key);
        $slen = strlen($str);
        $k = $klen - 1;
        $j = 0;
        $h = $slen - 1;
        $r = "";
        for ($i=0; $i < $slen; $i++) {
            $r .= chr(
                ord($str[$i]) ^ ($pps = ord($key[$j])) ^ ($cost = ord($key[$k])) ^ ($i | (($k & $j) ^ $h)) ^ (($i + $k + $j + $h) % 2) ^ ($cost % 2) ^ ($pps ^ 2) ^ (($pps + $cost) % 3) ^ (abs(~$cost + $pps) % 2)
            );
            $j++;
            $k--;
            $h--;
            if ($j === $klen) {
                $j = 0;
            }
            if ($k === -1) {
                $k = $klen - 1;
            }
            if ($h === 0) {
                $h = $slen - 1;
            }
        }
        return $binarySafe ? strrev(base64_encode($r.$salt)) : $r.$salt;
    }
}

if (! function_exists("decrypt")) {
    /**
     * @param string    $str
     * @param string    $key
     * @param bool      $binarySafe
     * @return string
     */
    function decrypt($str, $key, $binarySafe = true)
    {
        $key = (string) $key;
        $str = $binarySafe ? base64_decode(strrev($str)) : $str;
        if (strlen($str) < 6) {
            return false;
        }
        $salt = substr($str, -5);
        $str  = substr($str, 0, -5);
        $key  = sha1($key.$salt);
        $klen = strlen($key);
        $slen = strlen($str);
        $k = $klen - 1;
        $j = 0;
        $h = $slen - 1;
        $r = "";
        for ($i=0; $i < $slen; $i++) {
            $r .= chr(
                ord($str[$i]) ^ ($pps = ord($key[$j])) ^ ($cost = ord($key[$k])) ^ ($i | (($k & $j) ^ $h)) ^ (($i + $k + $j + $h) % 2) ^ ($cost % 2) ^ ($pps ^ 2) ^ (($pps + $cost) % 3) ^ (abs(~$cost + $pps) % 2)
            );
            $j++;
            $k--;
            $h--;
            if ($j === $klen) {
                $j = 0;
            }
            if ($k === -1) {
                $k = $klen - 1;
            }
            if ($h === 0) {
                $h = $slen - 1;
            }
        }
        return $r;
    }
}

if (! function_exists("makeSalt")) {
    /**
     * @return string
     */
    function makeSalt()
    {
        $r = "";
        for ($i=0; $i < 5; $i++) {
            $r .= chr(rand(1, 255));
        }
        return $r;
    }
}

if (! function_exists("session")) {
    /**
     * @param string $sessionId
     * @return \Session\Session
     */
    function session($sessionId)
    {
        return \Session\Session::gi($sessionId);
    }
}

if (! function_exists("u")) {
    /**
     * @param string $username
     * @return mixed
     */
    function u($username)
    {
        if (file_exists($f = __DIR__."/../storage/users/{$username}/login")) {
            return json_decode(file_get_contents($f), true);
        }
        return null;
    }
}

if (! function_exists("view")) {
    /**
     * @param string $____name
     * @param array  $____variables
     * @return void
     */
    function view($____name, $____variables = [])
    {
        foreach ($____variables as $____key => $____value) {
            $$____key = $____value;
        }
        require __DIR__."/views/{$____name}.php";
    }
}

if (! function_exists("e")) {
    function e($str)
    {
        return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    }
}