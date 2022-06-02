package document;

import observer.ObservedInterface;
import observer.ObserverInterface;
import shape.ShapeInterface;

import java.util.ArrayList;

public class Document implements DocumentInterface, ObservedInterface {
    private ArrayList<ShapeInterface> shapes;
    private ArrayList<ObserverInterface> observers;

    public Document()
    {
        this.shapes = new ArrayList<ShapeInterface>();
        this.observers = new ArrayList<ObserverInterface>();
    }

    public ArrayList<ShapeInterface> getShapes()
    {
        return this.shapes;
    }

    public void addShape(ShapeInterface shape)
    {
        this.shapes.add(shape);
        this.sendUpdate();
    }

    public void removeShape(ShapeInterface shape)
    {
        this.shapes.remove(shape);
        this.sendUpdate();
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
                    this.sendUpdate();
                } else {
                    shape.setSelected(false);
                    this.sendUpdate();
                }
            });
        });
    }

    @Override
    public void register(ObserverInterface observer) {
        this.observers.add(observer);
    }

    private void sendUpdate() {
        this.observers.forEach(ObserverInterface::update);
    }
}
