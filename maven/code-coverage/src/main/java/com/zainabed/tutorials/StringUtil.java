package com.zainabed.tutorials;

public class StringUtil {
    public int findIntegerCount(String input) {

        if (input == null) {
            return 0;
        }

        int count = 0;
        for (int index = 0; index < input.length(); index++) {
            char character = input.charAt(index);
            if (character >= 48 && character <= 57) {
                count++;
            }
        }

        return count;
    }
}
