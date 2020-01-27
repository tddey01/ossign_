<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Powerless < wzxaini9@gmail.com>
// +----------------------------------------------------------------------

namespace app\user\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;

/**
 * Class AdminIndexController
 * @package app\user\controller
 *
 * @adminMenuRoot(
 *     'name'   =>'用户管理',
 *     'action' =>'default',
 *     'parent' =>'',
 *     'display'=> true,
 *     'order'  => 10,
 *     'icon'   =>'group',
 *     'remark' =>'用户管理'
 * )
 *
 * @adminMenuRoot(
 *     'name'   =>'用户组',
 *     'action' =>'default1',
 *     'parent' =>'user/AdminIndex/default',
 *     'display'=> true,
 *     'order'  => 10000,
 *     'icon'   =>'',
 *     'remark' =>'用户组'
 * )
 */
class AdminIndexController extends AdminBaseController
{

    /**
     * 后台本站用户列表
     * @adminMenu(
     *     'name'   => '本站用户',
     *     'parent' => 'default1',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '本站用户',
     *     'param'  => ''
     * )
     */
    public function index()
    {
        $content = hook_one('user_admin_index_view');
        if (!empty($content)) {
            return $content;
        }

        $list = Db::name('user')
            ->where('user_type=2')
            ->where(function (Query $query) {
                $data = $this->request->param();
                if (!empty($data['uid'])) {
                    $query->where('id', intval($data['uid']));
                }
                if (!empty($data['keyword'])) {
                    $keyword = $data['keyword'];
                    $query->where('user_login|user_nickname|user_email|mobile', 'like', "%$keyword%");
                }
            })
            ->order("create_time DESC")
            ->paginate(10);
        // 获取分页显示
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        // 渲染模板输出
        return $this->fetch();
    }

    //添加会员
    public function add()
    {
        $content = hook_one('user_adminIndex_add_view');

        if (!empty($content)) {
            return $content;
        }

        $roles = Db::name('role')->where('status', 1)->order("id DESC")->select();
        $this->assign("roles", $roles);
        return $this->fetch();
    }

    /**
     * 会员添加提交
     * @adminMenu(
     *     'name'   => '会员添加提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '会员添加提交',
     *     'param'  => ''
     * )
     */
    public function addPost()
    {
        if ($this->request->isPost()) {
            $name=$_POST['user_login'];
            if ($name==''){
                $this->error("用户名为空！");
            }
            $password=$_POST['user_pass'];
            if($password==''){
                $this->error("密码为空！");
            }
            $email=$_POST['user_email'];
            if($email==''){
                $this->error("邮箱为空！");
            }          
            $map[]=['user_login','=',$name];
            $isexist=Db::name('user')->where($map)->find();
            if ($isexist) {
                $this->error("该用户名已存在！");
            }
            if (!empty($_POST['role_id']) && is_array($_POST['role_id'])) {
                $role_ids = $_POST['role_id'];
                unset($_POST['role_id']);
                /**$result = $this->validate($this->request->param(), 'user');
                if ($result !== true) {
                    $this->error($result);
                } else {**/
                    $_POST['user_pass'] = cmf_password($_POST['user_pass']);
                    $_POST['user_type'] = 2;
                    $result             = DB::name('user')->insertGetId($_POST);
                    if ($result !== false) {
                        //$role_user_model=M("RoleUser");
                        foreach ($role_ids as $role_id) {
                            if (cmf_get_current_admin_id() != 1 && $role_id == 1) {
                                $this->error("为了网站的安全，非网站创建者不可创建超级管理员！");
                            }
                            Db::name('RoleUser')->insert(["role_id" => $role_id, "user_id" => $result]);
                        }
                        $this->success("添加成功！", url("user/adminIndex/index"));
                    } else {
                        $this->error("添加失败！");
                    }
                //}
            } else {
                $this->error("请为此用户指定角色！");
            }
        }
    }

    public function edit()
    {        
        $content = hook_one('admin_adminindex_edit_view');
        if (!empty($content)) {
            return $content;
        }
        $id    = $this->request->param('id', 0, 'intval');
        $roles = DB::name('role')->where('status', 1)->order("id DESC")->select();
        $this->assign("roles", $roles);
        $role_ids = DB::name('RoleUser')->where("user_id", $id)->column("role_id");
        $this->assign("role_ids", $role_ids);
        $user = DB::name('user')->where("id", $id)->find();
        $this->assign($user);
        return $this->fetch();
    }    

    /**
     * 会员编辑提交
     * @adminMenu(
     *     'name'   => '会员编辑提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '会员编辑提交',
     *     'param'  => ''
     * )
     */
    public function editPost()
    {
        if ($this->request->isPost()) {
            $password=$_POST['user_pass'];
            if($password==''){
                $this->error("密码为空！");
            }
            if (!empty($_POST['role_id']) && is_array($_POST['role_id'])) {
                if (empty($_POST['user_pass'])) {
                    unset($_POST['user_pass']);
                } else {
                    $_POST['user_pass'] = cmf_password($_POST['user_pass']);
                }
                $role_ids = $this->request->param('role_id/a');
                unset($_POST['role_id']);
                $result = DB::name('user')->update($_POST);
                if ($result !== false) {
                    $uid = $this->request->param('id', 0, 'intval');
                    DB::name("RoleUser")->where("user_id", $uid)->delete();
                    foreach ($role_ids as $role_id) {
                        if (cmf_get_current_admin_id() != 1 && $role_id == 1) {
                            $this->error("为了网站的安全，非网站创建者不可创建超级管理员！");
                        }
                        DB::name("RoleUser")->insert(["role_id" => $role_id, "user_id" => $uid]);
                    }
                    $this->success("保存成功！");
                } else {
                    $this->error("保存失败！");
                }
            } else {
                $this->error("请为此用户指定角色！");
            }
        }
    }

    /**
     * 本站用户拉黑
     * @adminMenu(
     *     'name'   => '本站用户拉黑',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '本站用户拉黑',
     *     'param'  => ''
     * )
     */
    public function ban()
    {
        $id = input('param.id', 0, 'intval');
        if ($id) {
            $result = Db::name("user")->where(["id" => $id, "user_type" => 2])->setField('user_status', 0);
            if ($result) {
                $this->success("会员拉黑成功！", "adminIndex/index");
            } else {
                $this->error('会员拉黑失败,会员不存在,或者是管理员！');
            }
        } else {
            $this->error('数据传入失败！');
        }
    }

    /**
     * 本站用户启用
     * @adminMenu(
     *     'name'   => '本站用户启用',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '本站用户启用',
     *     'param'  => ''
     * )
     */
    public function cancelBan()
    {
        $id = input('param.id', 0, 'intval');
        if ($id) {
            Db::name("user")->where(["id" => $id, "user_type" => 2])->setField('user_status', 1);
            $this->success("会员启用成功！", '');
        } else {
            $this->error('数据传入失败！');
        }
    }

    /**
     * 会员充值
     * @adminMenu(
     *     'name'   => '会员充值',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '会员充值',
     *     'param'  => ''
     * )
     */
    public function deposit()
    {
        $id   = $this->request->param('id', 0, 'intval');        
        $user = DB::name('user')->where("id", $id)->find();
        $this->assign($user);
        return $this->fetch();
    }

    public function depositPost()
    {        
        if ($this->request->isPost()) {
            $uid = $this->request->param('id', 0, 'intval');
            $coin = $this->request->param('coin', 0, 'intval');     
            if ($coin=='') {
                $this->error("充值点数为空！");
            }       
            $user = DB::name('user')->where("id", $uid)->find();
            if(!$user){
                return $this->error("会员不存在！");
            }
            $coin+=$user['coin'];
            Db::name('user')->where([
                'id'  => $uid
            ])->update(["coin" => $coin]);            
            $this->success("充值成功！", url("user/adminIndex/index"));
        }
    }
}
