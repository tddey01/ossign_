package onlinewawa.ossign.service;

import onlinewawa.ossign.dao.DeviceDao;
import onlinewawa.ossign.pojo.Device;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

/**
 * @author ：ossign
 * @date ：Created in 2019-06-26 21:22
 * @description：设备管理
 * @modified By：
 * @version: 1.0
 */
@Service
public class DeviceServiceImpl {

    @Autowired
    private DeviceDao deviceDao;

    public Device getDeviceByUDID(String udid) {
        return deviceDao.getDeviceByUDID(udid);
    }

    public int insertDevice(String udid, Long appleId, String  deviceId) {
        return deviceDao.insertDevice(udid, appleId, deviceId);
    }

}
