package onlinewawa.ossign.pojo;

import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;

@ApiModel(value = "用户设备对象")
public class UserDevice {

    @ApiModelProperty(value = "uid")
    private long uid;

    @ApiModelProperty(value = "设备udid")
    private String udid;

    @ApiModelProperty(value = "开发者账号ID")
    private long apple_id;

    @ApiModelProperty(value = "添加时间")
    private long create_time;

    public long getUid() {
        return uid;
    }

    public void setUid(long uid) { this.uid = uid; }

    public String getUdid() {
        return udid;
    }

    public void setUdid(String udid) {
        this.udid = udid;
    }

    public long getApple_id() {
        return apple_id;
    }

    public void setApple_id(long apple_id) {
        this.apple_id = apple_id;
    }

    public long getCreate_time() {
        return create_time;
    }

    public void setCreate_time(long create_time) {
        this.create_time = create_time;
    }


    @Override
    public String toString() {
        return "UserDevice{" +
                "uid=" + uid +
                ", udid='" + udid + '\'' +
                ", apple_id" + apple_id +
                ", create_time=" + create_time +
                '}';
    }
}
