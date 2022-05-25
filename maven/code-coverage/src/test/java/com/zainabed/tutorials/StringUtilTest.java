package com.zainabed.tutorials;

import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.assertEquals;


class StringUtilTest {

    @Test
    void should_return_count_of_numeric_value() {
        StringUtil stringUtil = new StringUtil();
        String input = "1name34sample;";
        assertEquals(3, stringUtil.findIntegerCount(input));

        input = "namesample";
        assertEquals(0, stringUtil.findIntegerCount(input));
    }

    @Test
    void should_return_zero_for_empty_string() {
        StringUtil stringUtil = new StringUtil();
        assertEquals(0, stringUtil.findIntegerCount(null));
    }
}