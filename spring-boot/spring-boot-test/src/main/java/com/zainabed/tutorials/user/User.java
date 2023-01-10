package com.zainabed.tutorials.user;

import java.util.UUID;

public class User {
    private UUID uuid;
    private String name;
    private String address;

    public User( final String name, final String address) {
        this.name = name;
        this.address = address;
    }

    public UUID getUuid() {
        return uuid;
    }

    public void setUuid(final UUID uuid) {
        this.uuid = uuid;
    }

    public String getName() {
        return name;
    }

    public void setName(final String name) {
        this.name = name;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(final String address) {
        this.address = address;
    }
}
