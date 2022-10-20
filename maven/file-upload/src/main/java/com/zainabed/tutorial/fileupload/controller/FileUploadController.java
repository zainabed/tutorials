package com.zainabed.tutorial.fileupload.controller;

import com.zainabed.tutorial.fileupload.service.FileStorageService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.multipart.MultipartFile;

@RestController
public class FileUploadController {

    @Autowired
    FileStorageService fileStorageService;

    @PostMapping("file-upload")
    public ResponseEntity<String> uploadMultipartFile(@RequestParam("file") MultipartFile file) {
        fileStorageService.save(file);
        return ResponseEntity.ok("Received");
    }
}
