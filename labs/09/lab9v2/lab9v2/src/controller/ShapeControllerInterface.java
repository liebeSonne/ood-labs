package controller;

import shape.ShapesInterface;

public interface ShapeControllerInterface {
    public ShapesInterface getGroup();
    public void addTriangle();
    public void addRectangle();
    public void addEllipse();
}
