<?php
/**
 * Created by PhpStorm.
 * User: dave
 * Date: 2017/7/5
 * Time: 13:42
 */
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\SendController;
use Illuminate\Support\Facades\Input;

$datas=Input::all();

$ipaddr='http://1498kn1392.imwork.net';
echo $ipaddr;
//$appdata= (new SendController())->query($ipaddr,);

