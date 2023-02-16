package com.zainabed.tutorials.config;


import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;

import static org.junit.jupiter.api.Assertions.assertNotNull;

@SpringBootTest
class FileSettingConfigTest {

    @Autowired
    private FileSetting fileSetting;

    @Test
    void should_configured_file_settings() {
        assertNotNull(fileSetting.getName());
        assertNotNull(fileSetting.getPath());
    }
}