/**
 * Created by dave on 2017/7/10.
 */
window.setInterval(queryphData, 10000);
//window.setInterval(queryoxgData, 14000);

var times_1=0;
var times_2=0;
var value='0';
var devid='1';
var colorState;
var successState="btn btn-success";
var defaultState="btn btn-default";
function sendctrl(btn_id)
{
    if(btn_id=="btn1"){
        devid='1';
        if(times_1 % 2==0){
            value='1';//按键按下开启
            colorState=successState;
        }
        if(times_1 % 2==1){
            value='0';//按键关闭
            colorState=defaultState;
        }
        times_1++;
    }
    if(btn_id=="btn2"){
        devid='2';
        if(times_2 % 2==0){
            value='1';//按键按下开启
            colorState=successState;
        }
        if(times_2 % 2==1){
            value='0';//按键关闭
            colorState=defaultState;
        }
        times_2++;
    }
    document.getElementById(btn_id).setAttribute('class',colorState);
    controlData(devid,value);
}

function queryphData() {
    $.ajax({
        type : "POST",//提交方式
        url : "http://laravel.app/send",
        data : {
            '_token'     : $('#csrf_token').val(),
            'device'     : '2',
            'type'       : '2',
            'devid'    : '0',
            'cmdtype'     :'query'
        },
        success : function(result){
            var jsonObj = jQuery.parseJSON(result);
            if( jsonObj.message =='success'){
                if(jsonObj.data){
                    document.getElementById('phdata').setAttribute('value',jsonObj.data.ph);
                    queryoxgData();
                }
            }
        }
    });}
function queryoxgData(){
    $.ajax({
            type : "POST",//提交方式
            url : "http://laravel.app/send",
            data : {
                '_token'     : $('#csrf_token').val(),
                'device'     : '1',
                'type'       : '1',
                'devid'    : '0',
                'cmdtype'     :'query'
            },
            success : function(result){
                var jsonObj = jQuery.parseJSON(result);
                if( jsonObj.message =='success'){
                    document.getElementById('tempdata').setAttribute('value',jsonObj.data.tem);
                    document.getElementById('oxgdata').setAttribute('value',jsonObj.data.oxygen);
                }
            }
        }
    );}
//控制$ipaddr,$device,$type,$devid,$cmder,$value
function controlData(devid,value){
    $.ajax({
            type : "POST",//提交方式
            url : "http://laravel.app/send",
            data : {
                '_token'     : $('#csrf_token').val(),
                'device'     : '3',
                'type'       : '3',
                'devid'    : devid,
                'cmder'      : 'power',
                'cmdtype'     :'control',
                'value'       :value,
            },
            success : function(result){
                var jsonObj = jQuery.parseJSON(result);
                if( jsonObj.message =='success'){
                }
            }
        }
    );}

