package document;

import shape.ShapeInterface;

import java.util.ArrayList;

public interface DocumentInterface {
    public ArrayList<ShapeInterface> getShapes();

    public void addShape(ShapeInterface shape);

    public void removeShape(ShapeInterface shape);
}