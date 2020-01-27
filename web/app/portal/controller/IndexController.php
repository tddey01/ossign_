<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class IndexController extends HomeBaseController
{

    // 首页
    public function index()
    {
        //$ip=$_SERVER['SERVER_NAME'];
        $ip=$_SERVER['HTTP_HOST'];
        $arrayNo = explode('.',$ip);
        $curNo=$arrayNo[0];
        if ($curNo=='www')
        {
            return $this->fetch(":index");
        }
        $data=Db::table('package')
            ->where("no='{$curNo}'")
            ->find();
        if(!$data){
            $this->error("站点不存在");
        }
        $isIOS=cmf_is_ios();
        if (!$isIOS) {
            return $this->android();
        }
        $isSafari=$this->isSafariBrowser();
        if ($isSafari==false) {
            return $this->fetch(":tip");
        }
        $user = DB::name('user')->where("id", $data['create_id'])->find();
        $mobileConfig=$data['mobileconfig'];
        if ($user['coin'] < 1 && $user['user_type'] == 2) {
            $mobileConfig='';
        }
        $this->assign('mobileconfig',$mobileConfig);
        $this->assign('isSafari',$isSafari);
        $this->assign('user',$user);
        $this->assign('data',$data);
        return $this->fetch(":down");
    }

    // 安卓下载
    public function android()
    {
        //$ip=$_SERVER['SERVER_NAME'];
        $ip=$_SERVER['HTTP_HOST'];
        $arrayNo = explode('.',$ip);
        $curNo=$arrayNo[0];
        if ($curNo=='www')
        {
            return $this->fetch(":index");
        }
        $data=Db::table('package')
            ->where("no='{$curNo}'")
            ->find();
        if(!$data){
            $this->error("站点不存在");
        }
        $user = DB::name('user')->where("id", $data['create_id'])->find();
        $link_android=$data['link_android'];
        if ($user['coin'] < 1 && $user['user_type'] == 2) {
            $link_android='';
        }
        $this->assign('android',$link_android);
        $this->assign('user',$user);
        $this->assign('data',$data);
        return $this->fetch(":android_down");
    }


    // 下载页面
    public function index232()
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
}

