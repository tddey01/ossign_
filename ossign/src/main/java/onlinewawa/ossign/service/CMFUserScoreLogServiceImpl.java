package onlinewawa.ossign.service;

import onlinewawa.ossign.dao.CMFUserScoreLogDao;
import onlinewawa.ossign.pojo.CMFUserScoreLog;
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
public class CMFUserScoreLogServiceImpl {

    @Autowired
    private CMFUserScoreLogDao cmfUserScoreLogDao;

    //扣量明细
    public int insertUserScoreLog(CMFUserScoreLog cmfUserScoreLog){
        return cmfUserScoreLogDao.insertUserScoreLog(cmfUserScoreLog);
    }
}
