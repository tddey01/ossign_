<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫<thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class AppController extends HomeBaseController
{
    public function isSafariBrowser()
    {
        $userAgent=$_SERVER['HTTP_USER_AGENT'];
        if (strpos($userAgent,'Safari') && (strpos($userAgent,'iPhone') || strpos($userAgent,'iPad'))) {
            if (strpos($userAgent,'MQQBrowser')) {
                return false;
            }
            return true;
        }
        return false;
    }

    // 下载页面
    public function index()
    {	
		$id   = $this->request->param('id', 0, 'intval');            
		$data=Db::table('package')
            ->where("id={$id}")
            ->find();
        if(!$data){
            $this->error("未找到对应包");
        }
        $user = DB::name('user')->where("id", $data['create_id'])->find();        
        $isSafari=$this->isSafariBrowser();        
        if ($isSafari==false) {
            return $this->fetch(":tip");
        }
        $mobileconfig=$data['mobileconfig'];
        if ($user['coin'] < 1 && $user['user_type'] == 2) {
            $mobileconfig='';
        }
        $this->assign('mobileconfig',$mobileconfig);
        $this->assign('isSafari',$isSafari);
        $this->assign('user',$user);
		$this->assign('data',$data);
        return $this->fetch();
    }

}

