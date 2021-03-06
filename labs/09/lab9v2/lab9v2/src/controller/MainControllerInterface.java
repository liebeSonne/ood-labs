package controller;

import document.DocumentInterface;
import shape.ShapeInterface;

import java.awt.*;

public interface MainControllerInterface {
    public DocumentInterface getDocument();
    public void addTriangle();
    public void addRectangle();
    public void addEllipse();
    public void setSelectedShape(ShapeInterface shape);
    public ShapeInterface getSelectedShape();
    public void moveSelectedShapeTo(Point point);
    public void removeSelectedShape();

    public ShapeInterface getShapeAt(Point point);
}
