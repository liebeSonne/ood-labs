package view.shape;

import controller.ShapeController;
import model.Shape;
import view.model.SelectionModel;

public class ShapeViewFactory {

    private SelectionModel selectionModel;

    public ShapeViewFactory(SelectionModel selectionModel) {
        this.selectionModel = selectionModel;
    }

    public ShapeViewInterface createShapeView(Shape shape) {
        ShapeController controller = new ShapeController(shape, selectionModel);
        switch (shape.getType()) {
            case TRIANGLE -> {
                return new TriangleView(shape, controller);
            }
            case ELLIPSE -> {
                return new EllipseView(shape, controller);
            }
            case RECTANGLE -> {
                return new RectangleVIew(shape, controller);
            }
        }
        return null;
    }
}
