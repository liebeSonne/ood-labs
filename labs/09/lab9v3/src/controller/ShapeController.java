package controller;

import model.Shape;

public class ShapeController {
    private Shape shape;
    public ShapeController(Shape shape) {
        this.shape = shape;
    }

    public void onSelect() {
        // @TODO
        System.out.println("ShapeController::onSelect");
    }

    public void onUnselect() {
        // @TODO
        System.out.println("ShapeController::onUnselect");
    }

    public void onMove() {
        // @TODO
        System.out.println("ShapeController::onMove");
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
