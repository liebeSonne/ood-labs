package com.lab9v1;

import com.lab9v1.controller.MainController;
import com.lab9v1.model.Harmonica;
import com.lab9v1.view.App;

import javax.swing.*;
import java.util.ArrayList;

public class Main {
    public static void main(String[] args) {
        ArrayList<Harmonica> harmonics = new ArrayList<Harmonica>();
        MainController controller = new MainController(harmonics);

        App app = new App(controller);
        JPanel jPanel = app.getMainPanel();

        JFrame jFrame = getFrame(jPanel);
    }

    static JFrame getFrame(JPanel jPanel){
        JFrame jFrame = new JFrame();
        jFrame.setTitle("Chart Drawer");
        jFrame.setContentPane(jPanel);
        jFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        jFrame.pack();
        jFrame.setVisible(true);
        return jFrame;
    }
}
