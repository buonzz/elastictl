package com.buonzz.elastictl;

import javax.swing.*;
import com.buonzz.elastictl.ui.*;

public class Application {

	public static void main(String[] args) {

            FrameBuilder frameBuilder = new FrameBuilder();
	    JFrame f = frameBuilder.build();
	   
	     f.setExtendedState(f.getExtendedState() | JFrame.MAXIMIZED_BOTH);
	     f.setDefaultCloseOperation(WindowConstants.EXIT_ON_CLOSE);
             f.setVisible(true);//making the frame visible  
        }

}
