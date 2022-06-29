package view.shape;

import controller.ShapeController;

import model.Frame;
import model.Shape;
import model.Style;
import model.observer.ShapeObserver;

import javax.swing.*;
import java.awt.*;

public abstract class ShapeView extends JComponent implements ShapeViewInterface, ShapeObserver {
    protected ShapeController controller;
    protected Shape shape;
    protected Frame frame;

    public ShapeView(Shape shape) {
        super();
        this.shape = shape;
        this.controller = new ShapeController(shape);
        Frame frame = shape.getFrame();
        this.frame = new Frame(frame.getLeft(), frame.getTop(), frame.getWidth(), frame.getHeight());
        this.shape.registerShapeObserver(this);
    }

    public Shape getShape() {
        return shape;
    }

    @Override
    public abstract boolean contains(Point point);

    public abstract void draw(Graphics2D g2);

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        Graphics2D g2 = (Graphics2D) g;
        this.draw(g2);
    }

    @Override
    public boolean contains(int x, int y) {
        return contains(new Point(x, y));
    }

    public void onUpdateStyle(Style style) {
        repaint();
    }

    public void onUpdateFrame(Frame frame) {
        this.frame = new Frame(frame.getLeft(), frame.getTop(), frame.getWidth(), frame.getHeight());
        repaint();
    }

    public Frame getFrame() {
        return this.frame;
    }
}
