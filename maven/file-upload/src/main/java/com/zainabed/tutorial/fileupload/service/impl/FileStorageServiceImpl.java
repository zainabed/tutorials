package com.zainabed.tutorial.fileupload.service.impl;

import com.zainabed.tutorial.fileupload.service.FileStorageService;
import lombok.extern.log4j.Log4j2;
import org.springframework.stereotype.Service;
import org.springframework.web.multipart.MultipartFile;

@Log4j2
@Service
public class FileStorageServiceImpl implements FileStorageService {

    @Override
    public void save(MultipartFile file) {
        log.info("Saved file with name {}", file.getName());
    }
}
