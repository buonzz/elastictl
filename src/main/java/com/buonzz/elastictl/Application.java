package com.buonzz.elastictl;

import javax.swing.*;
import com.buonzz.elastictl.ui.*;
import io.searchbox.client.JestClient;
import io.searchbox.client.JestClientFactory;
import io.searchbox.client.JestResult;
import io.searchbox.client.config.HttpClientConfig;
import io.searchbox.indices.aliases.GetAliases;
import java.io.IOException;

public class Application {

	public static void main(String[] args) throws IOException {

            FrameBuilder frameBuilder = new FrameBuilder();
	    JFrame f = frameBuilder.build();
	   
	     f.setExtendedState(f.getExtendedState() | JFrame.MAXIMIZED_BOTH);
	     f.setDefaultCloseOperation(WindowConstants.EXIT_ON_CLOSE);
             f.setVisible(true);//making the frame visible  
             
            HttpClientConfig config;
            JestClientFactory factory;
            JestClient client;
            GetAliases aliases;
            JestResult result;
            String json;

            config = new HttpClientConfig.
               Builder("localhost:9200").
               build();

            aliases = new GetAliases.
               Builder().
               build();

            factory = new JestClientFactory();

            factory.setHttpClientConfig(config);

            client = factory.getObject();
            result = client.execute(aliases);
            json   = result.getJsonString();
            System.out.print(json);

        }

}
