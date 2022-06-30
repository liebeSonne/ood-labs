package controller;

import model.SelectionModel;
import model.factory.ShapeFactory;
import model.Document;
import model.Shape;
import model.ShapeType;
import view.data.ShapeDataViewInterface;

import java.util.ArrayList;

public class MenuController{
    private Document document;
    private ShapeDataViewInterface view;
    private ShapeFactory factory;
    private  SelectionModel selectionModel;

    public MenuController(Document document, ShapeDataViewInterface view, SelectionModel selectionModel) {
        this.document = document;
        this.view = view;
        this.selectionModel = selectionModel;
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

    public void onDelete() {
        System.out.println("MenuController::onDelete()");

        ArrayList<Shape> shapes = new ArrayList<Shape>();
        this.selectionModel.forEach(shape -> {
            shapes.add(shape);
        });

        shapes.forEach(shape -> {
            document.removeShape(shape);
        });
    }

}
