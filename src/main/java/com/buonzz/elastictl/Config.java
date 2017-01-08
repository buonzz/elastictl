package com.buonzz.elastictl;

import java.io.*;
import java.util.Properties;

public class Config {

    public final String PROPERTIES_FILE = "config.properties";
    public Properties properties = new Properties();    

    public Config() throws FileNotFoundException{ 
        InputStream inputStream = getClass().getClassLoader().getResourceAsStream(PROPERTIES_FILE);
        
            try {
                this.properties.load(inputStream);
            } catch (IOException e) {
                System.err.print(e.getMessage());
            }
    }
}
