package onlinewawa.ossign.service;

import onlinewawa.ossign.dao.CMFUserDao;
import onlinewawa.ossign.pojo.CMFUser;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

/**
 * @author ：ossign
 * @date ：Created in 2019-06-26 21:44
 * @description：会员管理
 * @modified By：
 * @version: 1.0
 */
@Service
public class CMFUserServiceImpl {

    @Autowired
    private CMFUserDao cmfUserDao;

    //更新用户剩余点数
    public int UpdateUserCoin(long id)
    {
        return cmfUserDao.updateUserCoin(id);
    }

    //获取用户信息
    public CMFUser GetUserById(long id){
        return cmfUserDao.getUserById(id);
    }
}
