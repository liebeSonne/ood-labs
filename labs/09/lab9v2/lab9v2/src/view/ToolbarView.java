package view;

import controller.ToolbarController;
import shape.ShapeType;

import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class ToolbarView extends JPanel {

    private JButton rectangleButton;
    private JButton triangleButton;
    private JButton ellipseButton;

    private final ToolbarController controller;

    public ToolbarView(ToolbarController controller
        , JButton rectangleButton
        , JButton triangleButton
        , JButton ellipseButton
    ) {
        this.controller = controller;

        this.rectangleButton = rectangleButton;
        this.triangleButton = triangleButton;
        this.ellipseButton = ellipseButton;

        this.initComponents();
        this.bindEvents();
    }

    private void initComponents() {
        System.out.println("ToolbarView::initComponents");
    }

    private void bindEvents() {
        System.out.println("ToolbarView::bindEvents");
        this.rectangleButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.onAddShape(ShapeType.RECTANGLE);
            }
        });
        this.triangleButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.onAddShape(ShapeType.TRIANGLE);
            }
        });
        this.ellipseButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.onAddShape(ShapeType.ELLIPSE);
            }
        });
    }

}
