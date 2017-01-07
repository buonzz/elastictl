package com.buonzz.elastictl.ui;

import java.awt.BorderLayout;

import javax.swing.*;

public class FrameBuilder {
	public JFrame build(){
		JFrame f=new JFrame();//creating instance of JFrame  
        
		JRootPane root = f.getRootPane();
		MenuBuilder menuBuilder = new MenuBuilder();
		JMenuBar bar = menuBuilder.build();
		
	    root.setJMenuBar(bar);
	    f.setLayout(new BorderLayout());//using no layout managers
	    return f;
	}
}