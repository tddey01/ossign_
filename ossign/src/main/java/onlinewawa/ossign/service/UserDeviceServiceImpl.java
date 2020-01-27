package onlinewawa.ossign.service;

import onlinewawa.ossign.pojo.UserDevice;
import onlinewawa.ossign.dao.UserDeviceDao;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class UserDeviceServiceImpl {

    @Autowired
    private UserDeviceDao userDeviceDao;

    //获取用户设备
    public UserDevice getUserDevice(long uid, String udid) {
        return userDeviceDao.getUserDevice(uid, udid);
    }

    //插入用户设备
    public int insertUserDevice(long uid,String udid,long appleId){
        return  userDeviceDao.insertUserDevice(uid, udid,appleId);
    }
}
