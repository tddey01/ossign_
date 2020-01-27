package onlinewawa.ossign.pojo;


import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;

@ApiModel(value = "用户对象")
public class CMFUserScoreLog {

    @ApiModelProperty(value = "id")
    private long id;

    @ApiModelProperty(value = "用户id")
    private long userId;

    @ApiModelProperty(value = "安装包id")
    private long packageId;

    @ApiModelProperty(value = "创建时间")
    private long createTime;

    @ApiModelProperty(value = "操作名称")
    private String action;

    @ApiModelProperty(value = "更改积分，可为负")
    private long score;

    @ApiModelProperty(value = "更改金币，可为负")
    private long coin;

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public long getUserId() {
        return userId;
    }

    public void setUserId(long userId) {
        this.userId = userId;
    }

    public long getPackageId() {
        return packageId;
    }

    public void setPackageId(long packageId) {
        this.packageId = packageId;
    }

    public long getCreateTime() {
        return createTime;
    }

    public void setCreateTime(long createTime) {
        this.createTime = createTime;
    }

    public String getAction() {
        return action;
    }

    public void setAction(String action) {
        this.action = action;
    }

    public long getScore() {
        return score;
    }

    public void setScore(long score) {
        this.score = score;
    }

    public long getCoin() {
        return coin;
    }

    public void setCoin(long coin) {
        this.coin = coin;
    }

    @Override
    public String toString() {
        return "CMFUserScoreLog{" +
                "id=" + id +
                ", userId=" + userId +
                ", createTime='" + createTime + '\'' +
                ", action='" + action + '\'' +
                ", score=" + score +
                ", coin=" + coin +
                '}';
    }
}
