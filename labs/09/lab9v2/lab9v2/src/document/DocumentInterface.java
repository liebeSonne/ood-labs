package document;

import shape.ShapeInterface;

import java.util.ArrayList;

public interface DocumentInterface {
    public ArrayList<ShapeInterface> getShapes();

    public void addShape(ShapeInterface shape);

    public void removeShape(ShapeInterface shape);

    public ArrayList<ShapeInterface> getSelectedShapes();

    public void setSelectedShapes(ArrayList<ShapeInterface> selectedShapes);

    public void translateShape(ShapeInterface shape, int x, int y);
}
