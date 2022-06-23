package view.form;

import controller.ToolbarController;
import model.Document;
import model.ShapeType;
import view.data.ShapeDataViewInterface;

import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class ToolbarView {
    private JPanel toolbarPanel;
    private JButton rectangleBtn;
    private JButton triangleBtn;
    private JButton ellipseBtn;

    ToolbarController controller;

    public ToolbarView(Document document, ShapeDataViewInterface dataView) {
        controller = new ToolbarController(document, dataView);

        this.bindEvents();
    }

    private void bindEvents() {
        System.out.println("ToolbarView::bindEvents");
        rectangleBtn.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.onAddShape(ShapeType.RECTANGLE);
            }
        });
        triangleBtn.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.onAddShape(ShapeType.TRIANGLE);
            }
        });
        ellipseBtn.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.onAddShape(ShapeType.ELLIPSE);
            }
        });
    }
}
