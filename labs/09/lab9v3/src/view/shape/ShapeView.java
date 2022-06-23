package view.shape;

import controller.ShapeController;

import model.Shape;

import java.awt.*;

public abstract class ShapeView implements ShapeViewInterface {
    protected ShapeController controller;
    protected Shape shape;

    public ShapeView(Shape shape) {
        this.shape = shape;
        this.controller = new ShapeController(shape);

    }
    @Override
    public abstract boolean contains(Point point);

    public abstract void draw(Graphics2D g2);
}
