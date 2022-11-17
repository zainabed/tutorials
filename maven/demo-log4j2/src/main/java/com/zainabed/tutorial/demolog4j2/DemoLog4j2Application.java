package com.zainabed.tutorial.demolog4j2;

import org.apache.logging.log4j.LogManager;
import org.apache.logging.log4j.Logger;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

@SpringBootApplication
public class DemoLog4j2Application {
    private static final Logger LOGGER = LogManager.getLogger(DemoLog4j2Application.class);
    public static void main(String[] args) {
        LOGGER.info("Application starts");
        SpringApplication.run(DemoLog4j2Application.class, args);
        LOGGER.info("Application ends");
    }
}
