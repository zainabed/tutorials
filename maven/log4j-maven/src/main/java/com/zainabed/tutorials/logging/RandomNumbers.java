package com.zainabed.tutorials.logging;

import org.apache.logging.log4j.LogManager;
import org.apache.logging.log4j.Logger;

public class RandomNumbers {
    public static final Logger logger = LogManager.getLogger();

    public static void printRandomNumbers(int loop) {

        for (int i = 0; i < loop; i++) {
            double random = Math.random();
            logger.fatal("Logging random number as {}", random);
        }
    }
}
