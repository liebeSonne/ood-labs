package controller;

import document.DocumentInterface;
import shape.ShapeInterface;
import shape.ShapesInterface;

import java.awt.*;

public interface ShapeControllerInterface {
    public DocumentInterface getDocument();
    public void addTriangle();
    public void addRectangle();
    public void addEllipse();
    public void setSelectedShape(ShapeInterface shape);
    public ShapeInterface getSelectedShape();
    public void moveSelectedShapeTo(Point point);
    public void removeSelectedShape();
}
