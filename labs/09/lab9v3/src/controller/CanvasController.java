package controller;

import model.Document;
import model.Shape;
import view.model.SelectionModel;

import java.util.ArrayList;

public class CanvasController {
    private Document document;
    private SelectionModel selectionModel;
    public CanvasController(Document document, SelectionModel selectionModel) {
        this.document = document;
        this.selectionModel = selectionModel;
    }

    public void onUnSelectAll() {
        System.out.println("CanvasController::onUnSelectAll()");
        ArrayList<Shape> shapes = new ArrayList<Shape>();
        selectionModel.forEach(shape -> {
            shapes.add(shape);
        });
        shapes.forEach(shape -> {
            selectionModel.unselected(shape);
        });
    }
}
