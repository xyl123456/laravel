<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SendController extends CommonController
{
    //public $ipaddr='http://1498kn1392.imwork.net:27216';
    public $ipaddr='http://192.168.0.148:8088';
    public function index()
    {
        $configs=Input::except('_token');
        if($configs['cmdtype']=='query'){
            $data=$this->query($this->ipaddr,$configs['device'],$configs['type'],$configs['devid']);
        }
        if($configs['cmdtype']=='control'){
            $data=$this->control($this->ipaddr,$configs['device'],$configs['type'],$configs['devid']);
        }

        //$json = json_decode($data, true);
       return $data;
    }
    public function query($ipaddr,$device,$type,$devid)
    {
        $ch = curl_init();
        $timeout=5;
        //$url="http://1498kn1392.imwork.net:27216/query.php?device=2&type=2&address=0";
        $url=$ipaddr.'/query.php?device='.$device.'&type='.$type.'&address='.$devid;
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch,CURLOPT_HEADER,0);
        //curl_setopt($ch, CURLOPT_WRITEFUNCTION, 'read_body');
        curl_exec($ch);
        $file_contents=curl_multi_getcontent($ch );
        curl_close($ch);
        return $file_contents;
    }

    public function control($ipaddr,$device,$type,$devid,$cmder,$value)
    {
        $ch = curl_init();
        $timeout=5;
        //$url="http://1498kn1392.imwork.net:27216/query.php?device=2&type=2&address=0";
        $url=$ipaddr.'/control.php?device='.$device.'&type='.$type.'&address='.$devid.
        '&cmd='.$cmder.'value='.$value;
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch,CURLOPT_HEADER,0);
        //curl_setopt($ch, CURLOPT_WRITEFUNCTION, 'read_body');
        curl_exec($ch);
        $file_contents=curl_multi_getcontent($ch);
        curl_close($ch);
        return $file_contents;
    }

}
