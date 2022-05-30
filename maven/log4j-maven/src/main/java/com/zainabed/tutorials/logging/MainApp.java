package com.zainabed.tutorials.logging;

import org.apache.logging.log4j.LogManager;
import org.apache.logging.log4j.Logger;

public class MainApp {

    public static void main(String[] args) {
        Logger logger = LogManager.getLogger();
        printLoggingLevels(logger);
    }

    private static void printLoggingLevels(Logger logger) {
        logger.trace("logging trace level");
        logger.debug("logging debug level");
        logger.info("logging info level");
        logger.warn("logging warn level");
        logger.error("logging error level");
        logger.fatal("logging fatal level");
    }
}
