package document;

import shape.ShapeInterface;

import java.util.ArrayList;

public class Document implements DocumentInterface {
    private ArrayList<ShapeInterface> shapes;

    public Document()
    {
        this.shapes = new ArrayList<ShapeInterface>();
    }

    public ArrayList<ShapeInterface> getShapes()
    {
        return this.shapes;
    }

    public void addShape(ShapeInterface shape)
    {
        this.shapes.add(shape);
    }

    public void removeShape(ShapeInterface shape)
    {
        this.shapes.remove(shape);
    }
}
