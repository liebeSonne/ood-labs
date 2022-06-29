package view;

import common.observer.Observer;
import controller.SelectionController;
import model.Shape;
import view.model.SelectionModel;

import javax.swing.*;
import java.awt.*;
import java.util.LinkedHashMap;

public class SelectionView extends JComponent implements Observer {
    private final SelectionModel model;
    private final SelectionController controller;

    private LinkedHashMap<Shape, SelectionShapeView> shapeMap = new LinkedHashMap<Shape, SelectionShapeView>();

    public SelectionView(SelectionModel model) {
        this.model = model;
        this.model.registerObserver(this);
        this.controller = new SelectionController(model, this);
        updateSelectionShapeViews();
    }

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        Graphics2D g2 = (Graphics2D) g;

        model.forEach(shape -> {
            SelectionShapeView view = new SelectionShapeView(shape.getFrame());
            shape.registerShapeObserver(view);
            view.draw(g2);
        });
    }

    public void draw(Graphics2D g2) {
        paintComponent(g2);
    }

    @Override
    public void update() {
        updateSelectionShapeViews();
    }

    private void updateSelectionShapeViews() {
        model.forEach(item -> {
            if (shapeMap.get(item) == null) {
                SelectionShapeView view = new SelectionShapeView(item.getFrame());
                item.registerShapeObserver(view);
                shapeMap.put(item, view);
                repaint();
            }
        });
    }
}
