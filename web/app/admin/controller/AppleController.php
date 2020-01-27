<?php

/* 账号 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class AppleController extends AdminBaseController
{

    public function index()
    {
        
        $list = Db::table('apple')
            ->order("id desc")
            ->paginate(20);
        
        $page = $list->render();
        $this->assign("page", $page);
            
        $this->assign('list', $list);

        return $this->fetch();
    }


    public function add()
    {
        return $this->fetch();
    }

    public function addPost()
    {
        if ($this->request->isPost()) {
			$data = $this->request->param();
			
			$account=$data['account'];
            $p8=$data['p8'];
            $csr=$data['csr'];
            $iss=$data['iss'];
            $kid=$data['kid'];

            if($account == ''){
                $this->error('请填写');
            }
			$post=[
				'account'=>$account,
				'p8'=>$p8,
				'csr'=>$csr,
				'iss'=>$iss,
				'kid'=>$kid,
			];

			$siteInfo = cmf_get_site_info();
			
			$url=$siteInfo['api_http'].'/apple/insertAppleAccount';
			
			$rs=curl_post($url,http_build_query($post));
			
			$rs_a=json_decode($rs,true);
			
			if(isset($rs_a['code']) && $rs_a['code']==0){
				 $this->error($rs_a['msg']);
			}
			
			$this->success("开发者账号添加成功");
			
        }
    }

    public function edit()
    {
        $id   = $this->request->param('id', 0, 'intval');
        
        $data=Db::table('apple')
            ->where("id={$id}")
            ->find();
        if(!$data){
            $this->error("信息错误");
        }
        
        $this->assign('data', $data);
        return $this->fetch();
    }

    public function editPost()
    {
        if ($this->request->isPost()) {
            $data      = $this->request->param();

            $id=$data['id'];
            $account=$data['account'];
            
            if($account == ''){
                $this->error('请填写名称');
            }
            
            $map[]=['account','=',$account];
            $map[]=['id','<>',$id];
            $isexist = Db::table('apple')->where($map)->find();
            if($isexist){
                $this->error('同名开发者账号已存在');
            }

            $rs = Db::table('apple')->update($data);

            if($rs === false){
                $this->error("保存失败！");
            }
            $this->success("保存成功！");
        }
    }
    
    public function listOrder()
    {
        $model = Db::table('apple');
        parent::listOrders($model);
        $this->success("排序更新成功！");
    }

    public function del()
    {
        $id = $this->request->param('id', 0, 'intval');
        
        $rs = Db::table('apple')->where('id',$id)->delete();
        if(!$rs){
            $this->error("删除失败！");
        }
        // 删除设备
        $drs = Db::table('device')->where('apple_id',$id)->delete();
        if (!$drs) {
            $this->error("删除设备失败！");
        }
        // 删除用户设备
        $udrs = Db::table('userdevice')->where('apple_id',$id)->delete();
        if (!$udrs) {
            $this->error("删除用户设备失败");
        }
        $this->success("删除成功！",url("apple/index"));
    }
    
    
    public function upload()
    {
        $id   = $this->request->param('id', 0, 'intval');
        $this->assign('id', $id);
        return $this->fetch();
    }

    public function uploadPost()
    {
        $id   = $this->request->param('id', 0, 'intval');
        $file=$_FILES['file'];
        $post=[
            'id'=>''.$id,
            'file'=>$file,
        ];
        
        $siteInfo = cmf_get_site_info();
        
        $url=$siteInfo['api_http'].'/apple/uploadP12';
        $rs=curlFile($url,$post);
        
        $rs_a=json_decode($rs,true);
        if(isset($rs_a['status'])){
             $this->error($rs_a['message']);
        }
        
        if(isset($rs_a['code']) && $rs_a['code']==0){
             $this->error($rs_a['msg']);
        }
        
        $this->success($rs_a['msg']);
    }

}