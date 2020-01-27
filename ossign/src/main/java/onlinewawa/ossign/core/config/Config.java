package onlinewawa.ossign.core.config;

public class Config {

    /** 账号最大可容纳设备量 */
    public final static int total = 100;

    /** 安装证书时显示的标题 */
    public final static String payloadDisplayName = "点击安装";

    /** 安装证书时显示的描述 */
    public final static String payloadDescription = "该配置文件帮助用户进行APP授权安装！This configuration file helps users with APP license installation!";

    /** 获取UDID请求地址（Java接口地址） */
    public final static String udidURL = "https://www.zacsqy.com";

    /** 重定向地址（PHP后台地址） */
    public final static String redirect = "http://www.zfkeaw.com";

    /** 组织名称 */
    public final static String payloadOrganization = "授权安装进入下一步";

    /** access key */
    public final static String accessKeyID = "LTAIXpBWaFG3ADYD";

    /** secret key */
    public final static String accessKeySecret = "BgqCCTYDJeh88kuGjTx0dSqqpBd4Mn";

    /** 地域节点 */
    public final static String endpoint = "https://oss-cn-hongkong.aliyuncs.com";

    /** 主内容 Bucket 域名 */
    public final static String aliMainHost = "https://qmht-2.oss-cn-hongkong.aliyuncs.com";

    /** 主内容空间名 */
    public final static String aliMainBucket = "qmht-2";

    /** 临时内容 Bucket 域名 */
    public final static String aliTempHost = "https://qmht-2.oss-cn-hongkong.aliyuncs.com";

    /** 临时内容空间名 */
    public final static String aliTempBucket = "qmht-2";

    /** 内网地域节点 */
    public final static String vpcEndpoint ="https://oss-cn-hongkong-internal.aliyuncs.com";

    /** 内网主内容 Bucket 域名 */
    public final static String vpcAliMainHost = "https://qmht-2.oss-cn-hongkong-internal.aliyuncs.com";

    /** 内网临时内容 Bucket 域名 */
    public final static String vpcAliTempHost = "https://qmht-2.oss-cn-hongkong-internal.aliyuncs.com";

    /**开启关闭GET请求*/
    public final static Boolean openGet = true;

    /**开启关闭POST请求*/
    public final static Boolean openPost = false;
}


