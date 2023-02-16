package com.zainabed.tutorials.config;

import org.springframework.boot.context.properties.ConfigurationProperties;
import org.springframework.context.annotation.Configuration;

import java.util.List;

@Configuration
@ConfigurationProperties(prefix = "app.settings")
public class ServiceSettingConfig {
    private List<ServiceSetting> services;

    public List<ServiceSetting> getServices() {
        return services;
    }

    public void setServices(final List<ServiceSetting> services) {
        this.services = services;
    }
}
