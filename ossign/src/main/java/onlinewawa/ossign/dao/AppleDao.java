package onlinewawa.ossign.dao;

import onlinewawa.ossign.pojo.Apple;
import org.apache.ibatis.annotations.*;

import java.util.List;

/**
 * @author ：ossign
 * @date ：Created in 2019-06-26 21:45
 * @description：开发者帐号
 * @modified By：
 * @version: 1.0
 */
@Mapper
public interface AppleDao {

    /**
     * create by: ossign
     * description: 添加开发者帐号
     * create time: 2019-06-29 17:57
     *

     * @return 是否添加成功
     */
    @Insert("INSERT INTO apple (account, count, p8, iss, kid, cerId, bundleIds) " +
            "VALUES (#{account}, #{count}, #{p8}, #{iss}, #{kid}, #{cerId}, #{bundleIds})")
    @Options(useGeneratedKeys=true, keyProperty="id", keyColumn="id")
    int insertAppleAccount(Apple apple);

    /**
      * create by: ossign
      * description: 更新账号P12
      * create time: 2019-07-06 14:59

      * @return 是否成功
      */
    @Update("UPDATE apple SET p12 = #{p12} WHERE id = #{id}")
    int updateAppleAccountWithP12(String p12, long id);

    /**
      * create by: ossign
      * description: 更新账号下设备数量
      * create time: 2019-07-06 16:24
      
      * @return 是否成功
      */
    @Update("UPDATE apple SET count = count-1 WHERE id = #{id} AND count>0")
    int updateAppleAccountDevicesCount(long id);

    /**
     * create by: ossign
     * description: 获取开发者帐号信息
     * create time: 2019-06-26 21:52
     *
     
     * @return Apple
     */
    @Select("SELECT * FROM apple WHERE account=#{account}")
    Apple getAppleAccountByAccount(String account);

    @Select("SELECT * FROM apple WHERE id=#{id}")
    Apple getAppleAccountById(long id);

    /**
      * create by: ossign
      * description: 获取全部账号信息
      * create time: 2019-07-23 09:29

      * @return List<Apple>
      */
    @Select("SELECT * FROM apple")
    List<Apple> getAllAppleAccounts();

    /**
     * create by: ossign
     * description: 获取一个可使用的开发者帐号
     * create time: 2019-06-26 21:59
     *

     * @return Apple
     */
    @Select("SELECT * FROM apple WHERE count<101 AND count>0 LIMIT 1")
    Apple getBeUsableAppleAccount();

}
