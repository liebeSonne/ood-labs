package view;

import controller.SelectionController;
import view.model.SelectionModel;

import javax.swing.*;
import java.awt.*;

public class SelectionView extends JComponent {
    private final SelectionModel model;
    private final SelectionController controller;

    public SelectionView(SelectionModel model) {
        this.model = model;
        this.controller = new SelectionController(model, this);
    }

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        Graphics2D g2 = (Graphics2D) g;

        model.forEach(shape -> {
            SelectionShapeView view = new SelectionShapeView(shape);
            view.draw(g2);
        });
    }

    public void draw(Graphics2D g2) {
        paintComponent(g2);
    }
}
