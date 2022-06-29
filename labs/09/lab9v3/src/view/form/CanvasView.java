package view.form;

import common.observer.Observer;
import controller.CanvasController;
import model.Document;
import model.Shape;
import model.observer.DocumentObserver;
import view.data.ShapeDataViewInterface;
import view.shape.ShapeViewFactory;
import view.shape.ShapeViewInterface;

import javax.swing.*;
import java.awt.*;
import java.util.*;

public class CanvasView extends JPanel implements ShapeDataViewInterface, Observer, DocumentObserver {
    private Document document;
    private CanvasController controller;
    private ShapeViewFactory factory;

    private LinkedHashMap<Shape, ShapeViewInterface> shapeMap;

    public CanvasView(Document document) {
        super();
        this.document = document;
        this.controller = new CanvasController(document);
        this.factory = new ShapeViewFactory();
        // this.document.registerObserver(this);
        this.document.registerDocumentObserver(this);

        this.shapeMap = new LinkedHashMap<Shape, ShapeViewInterface>();
        updateDocumentShapesView();
    }

    @Override
    public Point getCenter() {
        return new Point(this.getWidth() /2, this.getHeight() / 2);
    }

    @Override
    public void paintComponent(Graphics g) {
        super.paintComponent(g);
        Graphics2D g2 = (Graphics2D) g;

        for(Map.Entry<Shape, ShapeViewInterface> entry : shapeMap.entrySet()) {
            entry.getValue().draw(g2);
        }
    }

    @Override
    public void update() {
        repaint();
    }

    private void updateDocumentShapesView() {
        document.forEach(item -> {
            if (shapeMap.get(item) == null) {
                ShapeViewInterface view = factory.createShapeView(item);
                shapeMap.put(item, view);
                add((JComponent)view);
                repaint();
            }
        });
    }


    @Override
    public void onAddShape(Shape shape) {
        System.out.println("CanvasView::onAddShape");
        updateDocumentShapesView();
    }

    @Override
    public void onRemoveShape(Shape shape) {
        System.out.println("CanvasView::onRemoveShape");
        ShapeViewInterface view = shapeMap.get(shape);
        if (view != null) {
            shapeMap.remove(shape);
            remove((JComponent)view);
            repaint();
        }
    }

    @Override
    public void onUpdateShape(Shape shape) {
        System.out.println("CanvasView::onUpdateShape");
        ShapeViewInterface view = shapeMap.get(shape);
        if (view != null) {
            repaint();
        }
    }
}
