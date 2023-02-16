package com.zainabed.tutorials.config;

import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;

import static org.junit.jupiter.api.Assertions.*;

@SpringBootTest
class ServiceSettingConfigTest {

    @Autowired
    private ServiceSettingConfig serviceSettingConfig;

    @Test
    void should_contain_app_config_settings() {
        assertNotNull(serviceSettingConfig.getServices());
    }
}