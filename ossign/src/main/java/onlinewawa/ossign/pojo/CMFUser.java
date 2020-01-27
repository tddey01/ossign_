package onlinewawa.ossign.pojo;

import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;

@ApiModel(value = "用户对象")
public class CMFUser {

    @ApiModelProperty(value = "id")
    private long id;

    @ApiModelProperty(value = "用户类型：1.管理员，2.会员")
    private int userType;

    @ApiModelProperty(value = "性别")
    private int sex;

    @ApiModelProperty(value = "生日")
    private long birthday;

    @ApiModelProperty(value = "最后登录时间")
    private long lastLoginTime;

    @ApiModelProperty(value = "用户积分")
    private long score;

    @ApiModelProperty(value = "剩余点数")
    private int coin;

    @ApiModelProperty(value = "余额")
    private double balance;

    @ApiModelProperty(value = "注册时间")
    private long createTime;

    @ApiModelProperty(value = "用户状态")
    private int userStatus;

    @ApiModelProperty(value = "用户名")
    private String userLogin;

    @ApiModelProperty(value = "登录密码")
    private String userPass;

    @ApiModelProperty(value = "用户昵称")
    private String userNickname;

    @ApiModelProperty(value = "用户登录邮箱")
    private String userEmail;

    @ApiModelProperty(value = "个人网址")
    private String userUrl;

    @ApiModelProperty(value = "用户头像")
    private String avatar;

    @ApiModelProperty(value = "个性签名")
    private String signature;

    @ApiModelProperty(value = "最后登录IP")
    private String lastLoginIp;

    @ApiModelProperty(value = "激活码")
    private String userActivationKey;

    @ApiModelProperty(value = "手机号")
    private String mobile;

    @ApiModelProperty(value = "扩展属性")
    private String more;

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public int getUserType() {
        return userType;
    }

    public void setUserType(int userType) {
        this.userType = userType;
    }

    public int getSex() {
        return sex;
    }

    public void setSex(int sex) {
        this.sex = sex;
    }

    public long getBirthday() {
        return birthday;
    }

    public void setBirthday(long birthday) {
        this.birthday = birthday;
    }

    public long getLastLoginTime() {
        return lastLoginTime;
    }

    public void setLastLoginTime(long lastLoginTime) {
        this.lastLoginTime = lastLoginTime;
    }

    public long getScore() {
        return score;
    }

    public void setScore(long score) {
        this.score = score;
    }

    public int getCoin() {
        return coin;
    }

    public void setCoin(int coin) {
        this.coin = coin;
    }

    public double getBalance() {
        return balance;
    }

    public void setBalance(double balance) {
        this.balance = balance;
    }

    public long getCreateTime() {
        return createTime;
    }

    public void setCreateTime(long createTime) {
        this.createTime = createTime;
    }

    public int getUserStatus() {
        return userStatus;
    }

    public void setUserStatus(int userStatus) {
        this.userStatus = userStatus;
    }

    public String getUserLogin() {
        return userLogin;
    }

    public void setUserLogin(String userLogin) {
        this.userLogin = userLogin;
    }

    public String getUserPass() {
        return userPass;
    }

    public void setUserPass(String userPass) {
        this.userPass = userPass;
    }

    public String getUserNickname() {
        return userNickname;
    }

    public void setUserNickname(String userNickname) {
        this.userNickname = userNickname;
    }

    public String getUserEmail() {
        return userEmail;
    }

    public void setUserEmail(String userEmail) {
        this.userEmail = userEmail;
    }

    public String getUserUrl() {
        return userUrl;
    }

    public void setUserUrl(String userUrl) {
        this.userUrl = userUrl;
    }

    public String getAvatar() {
        return avatar;
    }

    public void setAvatar(String avatar) {
        this.avatar = avatar;
    }

    public String getSignature() {
        return signature;
    }

    public void setSignature(String signature) {
        this.signature = signature;
    }

    public String getLastLoginIp() {
        return lastLoginIp;
    }

    public void setLastLoginIp(String lastLoginIp) {
        this.lastLoginIp = lastLoginIp;
    }

    public String getUserActivationKey() {
        return userActivationKey;
    }

    public void setUserActivationKey(String userActivationKey) {
        this.userActivationKey = userActivationKey;
    }

    public String getMobile() {
        return mobile;
    }

    public void setMobile(String mobile) {
        this.mobile = mobile;
    }

    public String getMore() {
        return more;
    }

    public void setMore(String more) {
        this.more = more;
    }

    @Override
    public String toString() {
        return "CMFUser{" +
                "id=" + id + '\'' +
                ", user_type=" + userType +
                ", sex='" + sex + '\'' +
                ", coin='" + coin + '\'' +
                '}';
    }
}
