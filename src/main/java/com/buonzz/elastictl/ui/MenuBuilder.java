package com.buonzz.elastictl.ui;

import javax.swing.JMenu;
import javax.swing.JMenuBar;

public class MenuBuilder {
	public JMenuBar build(){
		// Create a menu bar
	    JMenuBar bar = new JMenuBar();
	    JMenu menu = new JMenu("File");
	    bar.add(menu);
	    menu.add("Open");
	    menu.add("Close");	
	    return bar;
	}
}
