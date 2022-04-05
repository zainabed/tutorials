package com.zainabed.cucumber.bdd;

import io.cucumber.java8.En;

import static org.junit.jupiter.api.Assertions.assertTrue;

public class UserRegistrationBDD implements En {

    public UserRegistrationBDD() {

        Given("User visit registration", () -> {
           // Add business logic
            assertTrue(true);
        });

        When("User enter his registration details", () -> {
            // Add business logic
            assertTrue(true);
        });

        Then("System validate the information", () -> {
            // Add business logic
            assertTrue(true);
        });

        Then("User get registered", () -> {
            // Add business logic
            assertTrue(true);
        });
    }

}
