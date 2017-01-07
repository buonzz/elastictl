package com.buonzz.elastictl;

import javax.swing.*;
import com.buonzz.elastictl.ui.*;
import io.searchbox.client.JestClient;
import io.searchbox.client.JestClientFactory;
import io.searchbox.client.config.HttpClientConfig;

public class Application {

	public static void main(String[] args) {

            FrameBuilder frameBuilder = new FrameBuilder();
	    JFrame f = frameBuilder.build();
	   
	     f.setExtendedState(f.getExtendedState() | JFrame.MAXIMIZED_BOTH);
	     f.setDefaultCloseOperation(WindowConstants.EXIT_ON_CLOSE);
             f.setVisible(true);//making the frame visible  
             
             JestClientFactory factory = new JestClientFactory();
            factory.setHttpClientConfig(new HttpClientConfig
                                   .Builder("http://localhost:9200")
                                   .multiThreaded(true)
                                   .build());
            JestClient client = factory.getObject();

        }

}
