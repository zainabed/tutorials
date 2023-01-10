package com.zainabed.tutorials.user;

import com.fasterxml.jackson.databind.ObjectMapper;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.web.servlet.WebMvcTest;
import org.springframework.boot.test.mock.mockito.MockBean;
import org.springframework.http.MediaType;
import org.springframework.test.web.servlet.MockMvc;

import static org.mockito.Mockito.when;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.post;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.status;

@WebMvcTest(UserController.class)
class UserControllerTest {

    @MockBean
    private UserService userService;

    @Autowired
    MockMvc mockMvc;

    private User userRequest;
    private User userResponse;

    @BeforeEach
    void setUp() {
        final String username = "test name";
        final String userAddress = "test address";
        userRequest = new User(username, userAddress);
        userResponse = new User(username, userAddress);
        when(userService.save(userRequest)).thenReturn(userResponse);
    }

    @Test
    void should_save_requested_user() throws Exception {
        final String requestBody = new ObjectMapper().writeValueAsString(userRequest);
        mockMvc.perform(post("/user").contentType(MediaType.APPLICATION_JSON)
                .content(requestBody))
                .andExpect(status().isOk());
    }
}