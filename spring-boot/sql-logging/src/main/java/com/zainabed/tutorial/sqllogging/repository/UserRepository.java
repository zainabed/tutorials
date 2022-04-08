package com.zainabed.tutorial.sqllogging.repository;

import com.zainabed.tutorial.sqllogging.entity.User;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface UserRepository extends JpaRepository<User, Integer> {

    List<User> findByUsernameIn(List<String> usernames);
}
