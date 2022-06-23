package controller;

import model.factory.ShapeFactory;
import model.Document;
import model.Shape;
import model.ShapeType;
import view.data.ShapeDataViewInterface;

public class ToolbarController {
    private Document document;
    private ShapeDataViewInterface view;
    private ShapeFactory factory;

    public ToolbarController(Document document, ShapeDataViewInterface view) {
        this.document = document;
        this.view = view;
        this.factory = new ShapeFactory();
    }

    public void onAddShape(ShapeType type) {
        Shape shape = factory.createShape(type, view.getCenter());
        if (shape != null) {
            this.document.addShape(shape);
        }
    }
}
