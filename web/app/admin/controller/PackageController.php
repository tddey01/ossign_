<?php

/* 兴趣爱好 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;
use cmf\phpqrcode\QRcode;

class PackageController extends AdminBaseController
{
    protected function getUser(){
        $list=Db::name('user')
            ->order("id desc")
            ->column('*','id');
        return $list;
    }

    public function index()
    {            
        $userId  =  cmf_get_current_admin_id();     
        $user = DB::name('user')->where("id", $userId)->find();
        $list = Db::table('package')
                ->where(function (Query $query) use ($user) {
                    //非管理员只能看到自己的应用
                    if ($user['user_type']==2) {
                        $query->where('create_id', $user['id']);
                    }
                })
                ->order("id desc")
                ->paginate(20);
                
        $list->each(function($v,$k){        
            $this->site_info=cmf_get_site_info();
            //生成下载地址    
            $value="http://".$v['no'].".".$this->site_info['down_http'];
            $v['downurl']=$value;   

            //生成二维码图片
            $errorCorrectionLevel = '0';	//容错级别 
            $matrixPointSize = 2;			//生成图片大小              
            $name=md5($value);
            $filename = 'upload/qr/'.$name.'.png';
            if(!file_exists($filename)){
                QRcode::png($value,$filename , $errorCorrectionLevel, $matrixPointSize, 2);
            }         
            $v['qr']=cmf_get_image_preview_url('/'.$filename);
            
            return $v;
        });
        
        $page = $list->render();
        $this->assign("page", $page);            
        $this->assign('list', $list);
        $this->assign('userlist',$this->getUser());
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
            $isexist = Db::table('package')->where($map)->find();
            if($isexist){
                $this->error('同名包名已存在');
            }

            $id = Db::table('package')->insertGetId($data);
            if(!$id){
                $this->error("添加失败！");
            }
            $this->success("添加成功！");
        }
    }

    public function edit()
    {
        $id   = $this->request->param('id', 0, 'intval');
        
        $data=Db::table('package')
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
            $isexist = Db::table('package')->where($map)->find();
            if($isexist){
                $this->error('同名包名已存在');
            }

            $rs = Db::table('package')->update($data);

            if($rs === false){
                $this->error("保存失败！");
            }
            $this->success("保存成功！");
        }
    }

    
    public function update()
    {
        $id   = $this->request->param('id', 0, 'intval');
        
        $data=Db::table('package')
            ->where("id={$id}")
            ->find();
        if(!$data){
            $this->error("信息错误");
        }
        
        $this->assign('data', $data);
        return $this->fetch();
    }

    public function updatePost()
    {
        if ($this->request->isPost()) {
            $data      = $this->request->param();

            $id=$data['id'];
            $name=$data['name'];            
	        $no=$data['no'];
            
            if($no == ''){
                $this->error('请填写下载码');
            }
            
            $map[]=['no','=',$no];
            $map[]=['id','<>',$id];
            $isexist = Db::table('package')->where($map)->find();
            if($isexist){
                $this->error('该下载码已存在');
            }

            $rs = Db::table('package')->update($data);

            if($rs === false){
                $this->error("保存失败！");
            }
            $this->success("保存成功！",url("package/index"));
        }
    }
    
    public function listOrder()
    {
        $model = Db::table('package');
        parent::listOrders($model);
        $this->success("排序更新成功！");
    }

    public function del()
    {
        $id = $this->request->param('id', 0, 'intval');
        
        $rs = Db::table('package')->where('id',$id)->delete();
        if(!$rs){
            $this->error("删除失败！");
        }
        $this->success("删除成功！",url("package/index"));
    }
    
    public function upload()
    {
        $id   = cmf_get_current_admin_id();        
        $this->assign("id",$id);
        $nonceStr = $this->createNonceStr();
        $this->assign("nonceStr", $nonceStr);
        return $this->fetch();
    }
    
    public function uploadPost()
    {
        $file=$_FILES['file'];
        $summary = $_POST['summary'];
        $createid = cmf_get_current_admin_id();
        $post=[
            'file'=>$file,
            'summary'=>$summary,
            'createid'=>$createid
        ];
        
        $siteInfo = cmf_get_site_info();
        
        $url=$siteInfo['api_http'].'/package/uploadPackage';
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

    // 上传Android应用
    public function uploadAndroid()
    {   
        $id   = $this->request->param('id', 0, 'intval');        
        $data = Db::table('package')->where("id={$id}")->find();
        if(!$data){
            $this->error("应用不存在");
        }        
        $this->assign('data', $data);
        return $this->fetch();
    }

    // 上传Android应用
    public function uploadIcon()
    {   
        $id   = $this->request->param('id', 0, 'intval');        
        $data = Db::table('package')->where("id={$id}")->find();
        if(!$data){
            $this->error("应用不存在");
        }        
        $this->assign('data', $data);
        return $this->fetch();
    }


    /**
     * 生成随机字符串
     * @param int $length
     * @return string
     */
    function createNonceStr($length = 6) {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

}