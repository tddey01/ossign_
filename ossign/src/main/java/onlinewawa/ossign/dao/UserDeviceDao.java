package onlinewawa.ossign.dao;

import onlinewawa.ossign.pojo.UserDevice;
import org.apache.ibatis.annotations.Insert;
import org.apache.ibatis.annotations.Mapper;
import org.apache.ibatis.annotations.Select;


/**
 * @author ：ossign
 * @date ：Created in 2019-06-26 21:23
 * @description：UserDeviceDao
 * @modified By：
 * @version: 1.0
 */
@Mapper
public interface UserDeviceDao {

    /**
     * create by: ossign
     * description: 获取设备
     * create time: 2019-06-26 21:32
     *

     * @return Device
     */
    @Select("SELECT * FROM userdevice WHERE uid=#{uid} AND udid=#{udid}")
    UserDevice getUserDevice(long uid,String udid);

    /**
     * create by: ossign
     * description: 添加用户设备到帐号
     * create time: 2019-06-29 13:50
     *

     * @return 是否添加成功
     */
    @Insert("INSERT INTO userdevice (uid, udid, apple_id) VALUES (#{uid},#{udid},#{appleId})")
    int insertUserDevice(long uid, String udid,long appleId);
}
