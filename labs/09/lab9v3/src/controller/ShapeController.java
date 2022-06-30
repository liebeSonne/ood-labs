package controller;

import controller.transfer.*;
import model.Shape;
import model.SelectionModel;

import java.util.ArrayList;

public class ShapeController {
    private final Shape shape;
    private final SelectionModel selectionModel;

    public ShapeController(Shape shape, SelectionModel selectionModel) {
        this.shape = shape;
        this.selectionModel = selectionModel;
    }

    public void onSelect() {
        System.out.println("ShapeController::onSelect");
        ArrayList<Shape> shapes = new ArrayList<Shape>();
        selectionModel.forEach(shape -> {
            shapes.add(shape);
        });
        shapes.forEach(shape -> {
            selectionModel.unselected(shape);
        });
        selectionModel.selected(shape);
    }

    public void onUnselect() {
        System.out.println("ShapeController::onUnselect");
        selectionModel.unselected(shape);
    }

    public void onMove() {
        // @TODO
        //System.out.println("ShapeController::onMove");
    }

    public void onDraggable(int offsetX, int offsetY) {
        System.out.println("ShapeController::onDraggable");
        if (selectionModel.isSelected(shape)) {
            System.out.println("ShapeController::onDraggable: oX=" + offsetX + ", oY=" + offsetY);

            Movable movable = new MovableShape(shape);
            ArrayList<Movable> movables = new ArrayList<Movable>();
            selectionModel.forEach(selected -> {
                movables.add(new MovableShape(selected));
            });
            Movables movablesShape = new MovablesShape(movables);

            MoveUseCase useCase = new MoveUseCase(movablesShape);
            useCase.move(movable, offsetX, offsetY);
        }
    }

    public void onResize() {
        // @TODO
        System.out.println("ShapeController::onResize");
    }

    public void onDelete() {
        // @TODO
        System.out.println("ShapeController::onDelete");
    }
}
