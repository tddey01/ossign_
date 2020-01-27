package onlinewawa.ossign.controls;

import cn.hutool.core.date.DateUtil;
import cn.hutool.core.io.file.FileWriter;
import cn.hutool.core.lang.UUID;
import cn.hutool.http.HttpUtil;
import com.dd.plist.*;
import io.swagger.annotations.Api;
import io.swagger.annotations.ApiImplicitParam;
import io.swagger.annotations.ApiImplicitParams;
import io.swagger.annotations.ApiOperation;
import onlinewawa.ossign.pojo.*;
import onlinewawa.ossign.pojo.Package;
import onlinewawa.ossign.service.*;
import onlinewawa.ossign.core.config.Config;
import onlinewawa.ossign.utils.FileManager;
import onlinewawa.ossign.utils.ITSUtils;
import onlinewawa.ossign.utils.Shell;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.*;
import java.net.URLEncoder;

/**
 * @author ：ossign
 * @date ：Created in 2019-06-26 20:39
 * @description：获取UDID
 * @modified By：
 * @version: 1.0
 */
@RestController
@Api(tags = {"获取UDID下载APP"})
@RequestMapping("/udid")
public class UDIDController {

    @Autowired
    private DeviceServiceImpl deviceService;

    @Autowired
    private AppleServiceImpl appleService;

    @Autowired
    private PackageServiceImpl packageService;

    @Autowired
    private UserDeviceServiceImpl userDeviceService;

    @Autowired
    private CMFUserServiceImpl cmfUserService;

    @Autowired
    private CMFUserScoreLogServiceImpl cmfUserScoreLogService;

    @Autowired
    private FileManager fileManager;

    @ApiOperation(value="/getUDID", notes="获取设备udid", produces = "application/json")
    @ApiImplicitParams(value = {
            @ApiImplicitParam(name = "id", value = "ipa id", required = true),
    })
    @PostMapping("/getUDID")
    public void getUDID(HttpServletResponse response, HttpServletRequest request, String id) throws UnsupportedEncodingException {
        response.setContentType("text/html;charset=UTF-8");

        long begin = System.currentTimeMillis();
        String ua = request.getHeader("User-Agent");
        System.out.println("当前时间: " + DateUtil.now() + "\n当前产品id： " + id + "\n当前用户User-Agent: " + ua);
        String itemService = null;
        try {
            request.setCharacterEncoding("UTF-8");
            //获取HTTP请求的输入流
            InputStream is = request.getInputStream();
            //已HTTP请求输入流建立一个BufferedReader对象
            BufferedReader br = new BufferedReader(new InputStreamReader(is,"UTF-8"));
            StringBuilder sb = new StringBuilder();
            //读取HTTP请求内容
            String buffer = null;
            while ((buffer = br.readLine()) != null) {
                sb.append(buffer);
            }
            String xml = sb.toString().substring(sb.toString().indexOf("<?xml"), sb.toString().indexOf("</plist>")+8);
            NSDictionary parse = (NSDictionary) PropertyListParser.parse(xml.getBytes());
            String udid = (String) parse.get("UDID").toJavaObject();
            itemService = analyzeUDID(udid, id);
            System.out.println("itemService文件名为: " + itemService);
        } catch (Exception e) {
            e.printStackTrace();
        }
        Package pck = packageService.getPackageById(id);

        String redirect = Config.redirect + "/detail.php?id=" + id + "&title=" + URLEncoder.encode(pck.getName(),"UTF-8") + "&icon=" + URLEncoder.encode(Config.aliMainHost +"/"+pck.getIcon(),"UTF-8");
        if (itemService!=null) {
            String encode = "itms-services://?action=download-manifest&url=" + Config.aliTempHost + "/" + itemService;

            redirect += "&itemService=" + URLEncoder.encode(encode, "UTF-8" );
            packageService.updatePackageCountById(Integer.valueOf(id));
        }
        long end = System.currentTimeMillis();
        long result = (end - begin)/1000;
        System.out.println("自动签名执行耗时: " + result + "秒");
        response.setHeader("Location", redirect);
        response.setStatus(301);
    }

    /**
     * create by: ossign
     * description: 分析UDID信息
     * create time: 2019-06-26 21:40
     *

     * @return void
     */
    String analyzeUDID(String udid, String id) {
        String itemService = null;
        Device device = deviceService.getDeviceByUDID(udid);
        if (device==null) {
            // 设备不存在于任何帐号下
            System.out.println("设备不存在");
            Apple apple = appleService.getBeUsableAppleAccount();
            if (apple==null) {
                // 没有找到合适的帐号
                System.out.println("没有找到合适的帐号");
            }else {
                // 找到合适的帐号
                Package pck = packageService.getPackageById(id);
                // 获取用户信息
                CMFUser user=cmfUserService.GetUserById(pck.getCreateId());
                if (user == null||(user.getCoin()<1&&user.getUserType()==2)) {
                    System.out.println("用户不存在或剩余点数不足");
                    return null;
                }
                // 用户设备
                UserDevice uDevice=userDeviceService.getUserDevice(pck.getCreateId(),udid);
                if (uDevice == null) {
                    // 插入用户设备
                    userDeviceService.insertUserDevice(pck.getCreateId(),udid,apple.getId());
                    // 会员才会扣减余额
                    if (user.getUserType()==2){
                        //扣减用户余额
                        cmfUserService.UpdateUserCoin(pck.getCreateId());
                        //写扣量明细
                        CMFUserScoreLog userScoreLog=new CMFUserScoreLog();
                        userScoreLog.setUserId(user.getId());
                        userScoreLog.setCoin(-1);
                        userScoreLog.setAction(udid);
                        userScoreLog.setPackageId(pck.getId());
                        cmfUserScoreLogService.insertUserScoreLog(userScoreLog);
                    }
                    packageService.updatePackageIssueCount(pck.getId());
                }
                // 重签名
                String resignNature = insertDevice(udid, apple, pck.getLink());
                // 生成描述文件
                itemService = software(resignNature, pck.getBundleIdentifier(), pck.getVersion(), pck.getName(),pck.getIcon());
            }
        }else {
            // 设备存在
            Apple apple = appleService.getAppleAccountById(device.getAppleId());
            // 应用信息
            Package pck = packageService.getPackageById(id);
            // 用户设备
            UserDevice uDevice=userDeviceService.getUserDevice(pck.getCreateId(),udid);
            if (uDevice == null) {
                // 获取用户信息
                CMFUser user=cmfUserService.GetUserById(pck.getCreateId());
                if (user == null||(user.getCoin()<1&&user.getUserType()==2)) {
                    System.out.println("用户不存在或剩余点数不足");
                    return null;
                }
                // 插入用户设备
                userDeviceService.insertUserDevice(pck.getCreateId(),udid,apple.getId());
                // 会员才会扣减余额
                if (user.getUserType()==2) {
                    // 扣减用户余额
                    cmfUserService.UpdateUserCoin(pck.getCreateId());
                    // 扣减用户余额
                    cmfUserService.UpdateUserCoin(pck.getCreateId());
                    //写扣量明细
                    CMFUserScoreLog userScoreLog=new CMFUserScoreLog();
                    userScoreLog.setUserId(user.getId());
                    userScoreLog.setCoin(-1);
                    userScoreLog.setAction(udid);
                    userScoreLog.setPackageId(pck.getId());
                    cmfUserScoreLogService.insertUserScoreLog(userScoreLog);
                }
                // 更新签发量
                packageService.updatePackageIssueCount(pck.getId());
            }
            // 重签名
            String resignNature = resignature(apple, device.getDeviceId(), pck.getLink());
            // 生成描述文件
            itemService = software(resignNature, pck.getBundleIdentifier(), pck.getVersion(), pck.getName(),pck.getIcon());
        }
        return itemService;
    }

    /**
     * create by: ossign
     * description: 添加设备
     * create time: 2019-06-26 23:11
     *

     * @return String
     */
    String insertDevice(String udid, Apple apple, String link) {
        System.out.println("找到合适的帐号");
        // 发现可用账号
        String key = null;
        String devId = ITSUtils.insertDevice(udid, new Authorize(apple.getP8(), apple.getIss(), apple.getKid()));
        int i = deviceService.insertDevice(udid, apple.getId(), devId);
        if (i==1) {
            appleService.updateAppleAccountDevicesCount(apple.getId());
            key = resignature(apple, devId, link);
        }
        return key;
    }

    /**
      * create by: ossign
      * description: 重签名
      * create time: 2019-07-06 08:42

      * @return String
      */
    String resignature(Apple apple, String devId, String appLink) {
        String key = null;
        // ResourceUtils.getURL("classpath:").getPath()
        String classPath = "/root/";
        long begin = System.currentTimeMillis();
        //System.out.println("devid:"+devId+",path:"+classPath);
        File mobileprovision = ITSUtils.insertProfile(apple, devId, classPath);
        long end = System.currentTimeMillis();
        long time = (end - begin)/1000;
        System.out.println("创建证书耗时: " + time + "秒");
        String command = null;
        if (mobileprovision==null) {
            System.out.println("文件创建失败");
        }else {
            System.out.println("文件创建成功");
            String appUrl = Config.vpcAliMainHost + "/" + appLink;
            System.out.println("appUrl 开始下载"+appUrl);
            HttpUtil.downloadFile(appUrl, classPath);
            System.out.println("ipa下载完成: " + appUrl);
            File app = new File(classPath+appLink);
            String p12Url = Config.vpcAliMainHost + "/" + apple.getP12();
            System.out.println("p12 开始下载"+p12Url);
            HttpUtil.downloadFile(p12Url, classPath);
            System.out.println("p12下载完成: " + p12Url);
            File p12 = new File(classPath+apple.getP12());
            // 调用本地shell脚本并传递必须参数
            command = "/root/ausign.sh " + app.getName() + " " +
                    p12.getName() + " " +
                    mobileprovision.getName();
            System.out.println("调用shell进行签名: " + command);
            try {
                begin = System.currentTimeMillis();
                boolean result = Shell.run(command);
                end = System.currentTimeMillis();
                time = (end - begin)/1000;
                System.out.println("签名返回结果："+result+"，签名脚本执行耗时: " + time + "秒");
                if (result) {
                    key = uploadIPA(app);
                }
            } catch (IOException | InterruptedException e) {
                e.printStackTrace();
            } finally {
               mobileprovision.delete();
               app.delete();
               p12.delete();
            }
        }
        return key;
    }

    /**
     * create by: ossign
     * description: 上传IPA
     * create time: 2019-07-05 13:11

     * @return void
     */
    String uploadIPA(File file) {
        String objName = UUID.randomUUID().toString().replace("-", "")+".ipa";
        System.out.println("开始上传最终ipa文件, 文件名: " + objName);
        fileManager.uploadFile(file, objName);
        System.out.println("文件上传完成");
     //   file.delete();
        System.out.println("ipa文件删除： " + objName);
        return objName;
    }

    /**
      * create by: ossign
      * description: 下载IPA的item-service
      * create time: 2019-07-06 10:34

      * @return
      */
    String software(String ipaUrl, String id, String version, String title,String icon) {
        ipaUrl = Config.aliTempHost + "/" + ipaUrl;
        System.out.println("ipaUrl: " + ipaUrl);
        String plist = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>  \n" +
                "<!DOCTYPE plist PUBLIC \"-//Apple//DTD PLIST 1.0//EN\" \"http://www.apple.com/DTDs/PropertyList-1.0.dtd\">  \n" +
                "<plist version=\"1.0\">  \n" +
                "<dict>  \n" +
                "    <key>items</key>  \n" +
                "    <array>  \n" +
                "        <dict>  \n" +
                "            <key>assets</key>  \n" +
                "            <array>  \n" +
                "                <dict>  \n" +
                "                    <key>kind</key>  \n" +
                "                    <string>software-package</string>  \n" +
                "                    <key>url</key>  \n" +
                "                    <string>"+ ipaUrl +"</string>  \n" +
                "                </dict>  \n" +
                "                <dict>  \n"+
                "                    <key>kind</key>  \n"+
                "                    <string>display-image</string>  \n"+
                "                    <key>needs-shine</key>  \n"+
                "                    <true />  \n"+
                "                    <key>url</key>  \n"+
                "                    <string>" + Config.aliMainHost + "/" + icon + "</string>  \n"+
				"           	</dict>  \n"+
                "            </array>  \n" +
                "            <key>metadata</key>  \n" +
                "            <dict>  \n" +
                "                <key>bundle-identifier</key>  \n" +
                "                <string>"+ id +"</string>  \n" +
                "                <key>bundle-version</key>  \n" +
                "                <string>" + version + "</string>  \n" +
                "                <key>kind</key>  \n" +
                "                <string>software</string>  \n" +
                "                <key>title</key>  \n" +
                "                <string>" + title + "</string>  \n" +
                "            </dict>  \n" +
                "        </dict>  \n" +
                "    </array>  \n" +
                "</dict>  \n" +
                "</plist> ";
        String filePath = "itemService_" + UUID.randomUUID().toString().replace("-", "") +".plist";
        FileWriter writer = new FileWriter(filePath);
        writer.write(plist);
        String itemService = uploadItemService(writer.getFile());
        writer.getFile().delete();
        return itemService;
    }

    /**
     * create by: ossign
     * description: 上传itemService
     * create time: 2019-07-04 11:18

     * @return plist名称
     */
    String uploadItemService(File file) {
        String objName = UUID.randomUUID().toString().replace("-", "")+".plist";
        fileManager.uploadFile(file, objName);
        return objName;
    }

}
