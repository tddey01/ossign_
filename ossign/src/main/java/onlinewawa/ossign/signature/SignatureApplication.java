package onlinewawa.ossign.signature;

import org.mybatis.spring.annotation.MapperScan;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.web.servlet.ServletComponentScan;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.transaction.annotation.EnableTransactionManagement;

/**
 * @author ossign
 */
@EnableTransactionManagement
@ComponentScan(basePackages = {"onlinewawa.ossign.*"})
@MapperScan(basePackages = {"onlinewawa.ossign.dao"})
@ServletComponentScan
@SpringBootApplication
public class SignatureApplication {

    public static void main(String[] args) {
        SpringApplication.run(SignatureApplication.class, args);
    }

}
