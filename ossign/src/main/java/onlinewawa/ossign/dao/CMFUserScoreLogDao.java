package onlinewawa.ossign.dao;

import onlinewawa.ossign.pojo.CMFUserScoreLog;
import org.apache.ibatis.annotations.Insert;
import org.apache.ibatis.annotations.Mapper;
import org.apache.ibatis.annotations.Options;

@Mapper
public interface CMFUserScoreLogDao {

    /**
     * create by: ossign
     * description: 添加金币明细
     * create time: 2019-06-29 17:57
     *

     * @return 是否添加成功
     */
    @Insert("INSERT INTO cmf_user_score_log(user_id, package_id, action, score, coin) "+
            "VALUES (#{userId},#{packageId},#{action},0,#{coin})")
    @Options(useGeneratedKeys=true, keyProperty="id", keyColumn="id")
    int insertUserScoreLog(CMFUserScoreLog cmfUserScoreLog);
}
