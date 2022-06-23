package controller;

import model.factory.ShapeFactory;
import model.Document;
import model.Shape;
import model.ShapeType;
import view.data.ShapeDataViewInterface;

public class MenuController{
    Document document;
    ShapeDataViewInterface view;
    ShapeFactory factory;

    public MenuController(Document document, ShapeDataViewInterface view) {
        this.document = document;
        this.view = view;
        this.factory = new ShapeFactory();
    }

    public void onExit() {
        System.exit(0);
    }

    public void onAddShape(ShapeType type) {
        Shape shape = factory.createShape(type, view.getCenter());
        if (shape != null) {
            document.addShape(shape);
        }
    }

}
