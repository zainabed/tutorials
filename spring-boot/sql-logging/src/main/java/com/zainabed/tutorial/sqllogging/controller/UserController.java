package com.zainabed.tutorial.sqllogging.controller;

import com.zainabed.tutorial.sqllogging.entity.User;
import com.zainabed.tutorial.sqllogging.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.MediaType;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.Arrays;
import java.util.List;


@RestController
@RequestMapping("user")
public class UserController {
    @Autowired
    UserRepository repository;

    @GetMapping(produces = "application/json")
    public List<User> getAll(){
        return repository.findAll();
    }

    @GetMapping(path = "/{username}", produces =  "application/json")
    public List<User> getByUsername(@PathVariable String username){
        List<String> usernames = Arrays.asList(username);
        return repository.findByUsernameIn(usernames);
    }
}
