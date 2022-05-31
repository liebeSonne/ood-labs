package document;

import shape.ShapeInterface;

import java.util.ArrayList;

public class Document implements DocumentInterface {
    private ArrayList<ShapeInterface> shapes;

    private ArrayList<ShapeInterface> selectedShapes;

    public Document()
    {
        this.shapes = new ArrayList<ShapeInterface>();
        this.selectedShapes = new ArrayList<ShapeInterface>();
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

    public ArrayList<ShapeInterface> getSelectedShapes() {
        return this.selectedShapes;
    }

    public void setSelectedShapes(ArrayList<ShapeInterface> selectedShapes) {
        this.selectedShapes.clear();
        selectedShapes.forEach(selectShape -> {
            this.shapes.forEach(shape -> {
                if (shape == selectShape) {
                    this.selectedShapes.add(shape);
                }
            });
        });
    }
}
