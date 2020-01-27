package onlinewawa.ossign.dao;

import onlinewawa.ossign.pojo.CMFUser;
import org.apache.ibatis.annotations.Mapper;
import org.apache.ibatis.annotations.Select;
import org.apache.ibatis.annotations.Update;

@Mapper
public interface CMFUserDao {

    /**
     * create by: ossign
     * description: 更新用户剩余点数
     * create time: 2019-07-06 16:24

     * @return 是否成功
     */
    @Update("UPDATE cmf_user SET coin = coin-1 WHERE id = #{id} AND coin>0")
    int updateUserCoin(long id);

    /**
     * create by: ossign
     * description: 获取用户信息
     * create time: 2019-07-06 16:24

     * @return 用户信息
     */
    @Select("SELECT * FROM cmf_user WHERE id=#{id}")
    CMFUser getUserById(long id);
}
