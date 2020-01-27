<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\db\Query;

/**
 * Class UserController
 * @package app\admin\controller
 * @adminMenuRoot(
 *     'name'   => '扣量明细',
 *     'action' => 'default',
 *     'parent' => 'user/AdminIndex/default',
 *     'display'=> true,
 *     'order'  => 10000,
 *     'icon'   => '',
 *     'remark' => '扣量明细'
 * )
 */
class UserScoreLogController extends AdminBaseController
{

    protected function getPackage(){
        $list=Db::table('package')
            ->order("id desc")
            ->column('*','id');
        return $list;
    }

    protected function getUser(){
        $list=Db::name('user')
            ->order("id desc")
            ->column('*','id');
        return $list;
    }

    /**
     * 扣量明细列表
     * @adminMenu(
     *     'name'   => '管理员',
     *     'parent' => 'default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '扣量明细列表',
     *     'param'  => ''
     * )
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $userId  =  cmf_get_current_admin_id();     
        $user = DB::name('user')->where("id", $userId)->find();

        $userscore = Db::name('user_score_log')
            ->where(function (Query $query) use ($user) {
                //非管理员只能看到自己的应用
                if ($user['user_type']==2) {
                    $query->where('user_id', $user['id']);
                }
            })
            ->order("id DESC")
            ->paginate(10);
        // 获取分页显示
        $page = $userscore->render();

        $this->assign("page", $page);
        $this->assign("userscore", $userscore);
        $this->assign("userlist",$this->getUser());
        $this->assign("packagelist", $this->getPackage());
        return $this->fetch();
    }

}