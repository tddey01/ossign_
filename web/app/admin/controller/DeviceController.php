<?php

/* 设备管理 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class DeviceController extends AdminBaseController
{
    protected function getApple(){
        $list=Db::table('apple')
            ->order("id desc")
            ->column('*','id');
        return $list;
    }
    public function index()
    {
        
        $list = Db::table('device')
            ->order("id desc")
            ->paginate(15);
        
        $page = $list->render();
        $this->assign("page", $page);
            
        $this->assign('list', $list);
        
        $this->assign('applist', $this->getApple());

        return $this->fetch();
    }


    public function add()
    {
        return $this->fetch();
    }

    public function addPost()
    {
        if ($this->request->isPost()) {
            $data      = $this->request->param();
            
            $name=$data['name'];
            
            if($name == ''){
                $this->error('请填写名称');
            }
            
            $map[]=['name','=',$name];
            $isexist = Db::table('device')->where($map)->find();
            if($isexist){
                $this->error('同名兴趣已存在');
            }

            $id = Db::table('device')->insertGetId($data);
            if(!$id){
                $this->error("添加失败！");
            }
            $this->success("添加成功！");
        }
    }

    public function edit()
    {
        $id   = $this->request->param('id', 0, 'intval');
        
        $data=Db::table('device')
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
            $name=$data['name'];
            
            if($name == ''){
                $this->error('请填写名称');
            }
            
            $map[]=['name','=',$name];
            $map[]=['id','<>',$id];
            $isexist = Db::table('device')->where($map)->find();
            if($isexist){
                $this->error('同名兴趣已存在');
            }

            $rs = Db::table('device')->update($data);

            if($rs === false){
                $this->error("保存失败！");
            }
            $this->success("保存成功！");
        }
    }
    
    public function listOrder()
    {
        $model = Db::table('device');
        parent::listOrders($model);
        $this->success("排序更新成功！");
    }

    public function del()
    {
        $id = $this->request->param('id', 0, 'intval');
        
        $rs = Db::table('device')->where('id',$id)->delete();
        if(!$rs){
            $this->error("删除失败！");
        }
        $this->success("删除成功！",url("device/index"));
    }

    public function upload()
    {
        return $this->fetch();
    }
    
    public function uploadPost()
    {
        $data      = $this->request->param();
        
        $udid=$data['udid'];
        
        $post=[
            'udid'=>$udid,
        ];

        $siteInfo = cmf_get_site_info();
        
        $url=$siteInfo['api_http'].'/device/insertDevice';
        
        $rs=curl_post($url,http_build_query($post));
        
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