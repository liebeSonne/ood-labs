package model.factory;

import model.Shape;
import model.ShapeType;
import model.Style;

import java.awt.*;
import java.util.Random;

public class ShapeFactory {
    public Shape createShape(ShapeType type, Point center) {
        switch (type) {
            case ELLIPSE, RECTANGLE, TRIANGLE -> {
                return this.getShape(type, center);
            }
        }
        return null;
    }

    private Color getRandomColor() {
        Random rand = new Random();
        return new Color(rand.nextInt(0xFFFFFF));
    }

    private Shape getShape(ShapeType type, Point center) {
        model.Frame frame = new model.Frame(center.x - 75, center.y - 75, 150, 150);
        Style style = new Style(getRandomColor(), getRandomColor());
        return new Shape(type, frame, style);
    }
}
