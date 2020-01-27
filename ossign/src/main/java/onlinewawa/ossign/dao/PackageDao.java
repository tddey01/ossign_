package onlinewawa.ossign.dao;

import onlinewawa.ossign.pojo.Package;
import org.apache.ibatis.annotations.Insert;
import org.apache.ibatis.annotations.Options;
import org.apache.ibatis.annotations.Select;
import org.apache.ibatis.annotations.Update;

import java.util.List;

/**
 * @author ：ossign
 * @date ：Created in 2019-06-28 19:25
 * @description：TODO
 * @modified By：
 * @version: 1.0
 */
public interface PackageDao {

    /**
      * create by: ossign
      * description: 添加IPA
      * create time: 2019-06-28 20:09
      *
      * @return 是否添加成功
      */
    @Insert("INSERT INTO package (name, no, icon, version, build_version, mini_version, bundle_identifier, summary, link, create_id) " +
            "VALUES (#{name}, #{no}, #{icon}, #{version}, #{buildVersion}, #{miniVersion}, #{bundleIdentifier}, #{summary}, #{link}, #{createId})")
    @Options(useGeneratedKeys=true, keyProperty="id", keyColumn="id")
    int insertPackage(Package pck);

    /**
     * create by: ossign
     * description: 更新证书信息
     * create time: 2019-07-04 11:36

     * @return void
     */
    @Update("UPDATE `package` t SET t.`mobileconfig` = #{mobileconfig} WHERE t.`id` = #{id}")
    void updateMobileconfig(String mobileconfig, long id);

    /**
      * create by: ossign
      * description: 更新IPA
      * create time: 2019-07-04 14:38

      * @return int
      */
    @Update("UPDATE `package` t SET t.`name` = #{name},t.`no`=#{no}, t.`icon` = #{icon}, t.`version` = #{version}, " +
            "t.`build_version` = #{buildVersion}, t.`mini_version` = #{miniVersion}, t.`summary` = #{summary}, " +
            "t.`link` = #{link},t.`link_android` = #{linkAndroid} WHERE t.`id` = #{id}")
    int updatePackage(Package pck);

    /**
      * create by: ossign
      * description: 更新ipa下载量
      * create time: 2019-07-23 09:50

      * @return int
      */
    @Update("UPDATE package SET count = count+1 WHERE id = #{id}")
    int updatePackageCountById(long id);

    /**
     * create by: ossign
     * description: 更新ipa签发量
     * create time: 2019-07-23 09:50

     * @return int
     */
    @Update("UPDATE package SET issue_count=issue_count+1 WHERE id=#{id}")
    int updatePackageIssueCount(long id);

    /**
      * create by: ossign
      * description: 获取指定IPA
      * create time: 2019-07-03 16:47

      * @return Package
      */
    @Select("SELECT * FROM package WHERE id=#{id}")
    Package getPackageById(String id);

    /**
     * create by: ossign
     * description: 根据BundleID和用户ID获取指定IPA
     * create time: 2019-07-03 16:47

     * @return Package
     */
    @Select("SELECT * FROM package WHERE bundle_identifier=#{bundleIdentifier} AND create_id=#{createId}")
    Package getPackageByBundleIdentifier(String bundleIdentifier,String createId);

    /**
      * create by: ossign
      * description: 获取指定IPA下载名称
      * create time: 2019-07-06 09:12

      * @return String
      */
    @Select("SELECT link FROM package WHERE id=#{id}")
    String getPackageLinkById(String id);

    /**
      * create by: ossign
      * description: 获取全部IPA
      * create time: 2019-07-03 16:27

      * @return List
      */
    @Select("SELECT * FROM package")
    List<Package> getAllPackage();

}
