package com.lab9v1;

import com.lab9v1.controller.MainController;
import com.lab9v1.model.Document;
import com.lab9v1.model.Formula;
import com.lab9v1.view.App;

import javax.swing.*;

public class Main {
    public static void main(String[] args) {
        Document document = new Document();
        MainController controller = new MainController(document);

        document.addHarmonica(3, Formula.SIN, -3, 0.3);
        document.addHarmonica(4.38, Formula.SIN, 2.25, 1.5);
        document.addHarmonica(1, Formula.COS, 1, 5);

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
