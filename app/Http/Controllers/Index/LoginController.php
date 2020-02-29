<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;


use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

//发送邮件
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    //发送邮件
    public function sendEmail(){
      $email='1328404468@qq.com';
      Mail::to($email)->send(new SendCode());
    }

    public function loginDo(){
    	$data=request()->except('_token');
    	$res=Users::where($data)->first();
    	if ($res) {
    		session(['user'=>$res]);
    		request()->session()->save();
    		return redirect('/');
    	}
    	return redirect('/index/index');
    }
    
    public function ajaxsend(){
        //接受注册页面的手机号
        //$moblie = '15075323276';
        $moblie = request()->moblie;
        
        $code = rand(1000,9999);
        //echo $code;die;
        $res = $this->sendSms($moblie,$code);
        //dd($res);
        if( $res['Code']=='OK'){
            session(['code'=>$code]);
            request()->session()->save();
            echo json_encode(['code'=>'00000','msg'=>'ok']);die;
        }
            echo json_encode(['code'=>'00001','msg'=>'短信发送失败']);die;
    }

    public function sendSms($moblie,$code){

          AlibabaCloud::accessKeyClient('LTAI4Fty6c5LkSKpz9Gvyqrc', 'MiszDDvLZ89cZYC7ooyJL5kU65tABN')
                                    ->regionId('cn-hangzhou')
                                    ->asDefaultClient();

          try {
          $result = AlibabaCloud::rpc()
                                ->product('Dysmsapi')
                                // ->scheme('https') // https | http
                                ->version('2017-05-25')
                                ->action('SendSms')
                                ->method('POST')
                                ->host('dysmsapi.aliyuncs.com')
                                ->options([
                                              'query' => [
                                                'RegionId' => "cn-hangzhou",
                                                'PhoneNumbers' => "$moblie",
                                                'SignName' => "乐柠",
                                                'TemplateCode' => "SMS_176535937",
                                                'TemplateParam' => "{code:$code}",
                                              ],
                                          ])
                                ->request();
               return $result->toArray();
              } catch (ClientException $e) {
                  return $e->getErrorMessage();
              } catch (ServerException $e) {
                  return $e->getErrorMessage();
              }

    }

    public function regDo(){
      $post=request()->except('_token');
      //判断验证码
      $code=session('code');
      if ($code!=$post['code']) {
        return redirect('/reg')->with('msg','您输入的验证码不对');
      }

      //密码和确认密码是否一致
      if ($post['pwd']!=$post['repwd']) {
        return redirect('/reg')->with('msg','俩次密码不一致');
      }

      //入库
      $user=[
        'moblie'=>$post['moblie'],
        'pwd'=>encrypt($post['pwd']),
        'add_time'=>time(),
      ];
      $res=Users::create($post);
    
    if ($res) {
      return redirect('/login');
    }
    
  }
}
