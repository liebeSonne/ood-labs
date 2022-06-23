package view.shape;

import model.Shape;

public class ShapeViewFactory {

    public ShapeViewInterface createShapeView(Shape shape) {
        switch (shape.getType()) {
            case TRIANGLE -> {
                return new TriangleView(shape);
            }
            case ELLIPSE -> {
                return new EllipseView(shape);
            }
            case RECTANGLE -> {
                return new RectangleVIew(shape);
            }
        }
        return null;
    }
}
