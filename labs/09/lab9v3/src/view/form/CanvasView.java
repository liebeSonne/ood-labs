package view.form;

import common.observer.Observer;
import controller.CanvasController;
import model.Document;
import view.data.ShapeDataViewInterface;
import view.shape.ShapeViewFactory;
import view.shape.ShapeViewInterface;

import javax.swing.*;
import java.awt.*;

public class CanvasView extends JPanel implements ShapeDataViewInterface, Observer {
    private Document document;
    private CanvasController controller;

    private ShapeViewFactory factory;
    public CanvasView(Document document) {
        super();
        this.document = document;
        this.controller = new CanvasController(document);
        this.factory = new ShapeViewFactory();
        this.document.registerObserver(this);
    }

    @Override
    public Point getCenter() {
        return new Point(this.getWidth() /2, this.getHeight() / 2);
    }

    @Override
    public void paintComponent(Graphics g) {
        super.paintComponent(g);
        Graphics2D g2 = (Graphics2D) g;

        document.forEach(shape -> {
            ShapeViewInterface view = factory.createShapeView(shape);
            if (view != null) {
                view.draw(g2);
            }
        });
    }

    @Override
    public void update() {
        repaint();
    }
}
