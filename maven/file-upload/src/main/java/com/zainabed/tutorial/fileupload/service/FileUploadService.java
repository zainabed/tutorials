package com.zainabed.tutorial.fileupload.service;

import lombok.extern.log4j.Log4j2;
import org.springframework.core.io.FileSystemResource;
import org.springframework.http.HttpEntity;
import org.springframework.http.HttpHeaders;
import org.springframework.http.HttpStatus;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.scheduling.annotation.Scheduled;
import org.springframework.stereotype.Service;
import org.springframework.util.LinkedMultiValueMap;
import org.springframework.util.MultiValueMap;
import org.springframework.web.client.RestTemplate;

import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;


@Service
@Log4j2
public class FileUploadService {

    public static final String FILE_PARAMETER_NAME = "file";
    public static final String FILE_UPLOAD_URL = "http://localhost:8090/file-upload";
    private final RestTemplate restTemplate;

    public FileUploadService() {
        restTemplate = new RestTemplate();
    }

    @Scheduled(fixedDelay = 1000)
    public boolean uploadMultipartFile() {

        final HttpHeaders httpHeaders = new HttpHeaders();
        httpHeaders.setContentType(MediaType.MULTIPART_FORM_DATA);

        final File uploadFile = getFile();
        final FileSystemResource fileSystemResource = new FileSystemResource(uploadFile);
        final MultiValueMap<String, Object> fileUploadMap = new LinkedMultiValueMap<>();
        fileUploadMap.set(FILE_PARAMETER_NAME, fileSystemResource);

        HttpEntity<MultiValueMap<String, Object>> httpEntity = new HttpEntity<>(fileUploadMap, httpHeaders);
        ResponseEntity<String> responseEntity = restTemplate.postForEntity(FILE_UPLOAD_URL, httpEntity, String.class);
        return responseEntity.getStatusCode().equals(HttpStatus.OK);
    }

    private File getFile() {
        try {
            Path file = Files.createTempFile("test", ".txt");
            log.info("file is created with name {}", file.getFileName());
            return file.toFile();
        } catch (IOException e) {
            e.printStackTrace();
        }
        return null;
    }
}
