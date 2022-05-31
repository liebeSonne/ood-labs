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

    public ArrayList<ShapeInterface> getSelectedShapes() {
        ArrayList<ShapeInterface> selectedShapes = new ArrayList<ShapeInterface>();
        this.shapes.forEach(shape -> {
            if (shape.isSelected()) {
                selectedShapes.add(shape);
            }
        });
        return selectedShapes;
    }

    public void setSelectedShapes(ArrayList<ShapeInterface> selectedShapes) {
        selectedShapes.forEach(selectShape -> {
            this.shapes.forEach(shape -> {
                if (shape == selectShape) {
                    shape.setSelected(true);
                } else {
                    shape.setSelected(false);
                }
            });
        });
    }
}
