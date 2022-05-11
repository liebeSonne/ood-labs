package controller;

import shape.*;
import shape.Frame;
import shape.Rectangle;
import java.util.Random;

import java.awt.*;

public class ShapeController implements ShapeControllerInterface {

    Point center;
    ShapesInterface group;

    public ShapeController(Point center, ShapesInterface group) {
        this.center = new Point(center.x, center.y);
        this.group = group;
    }

    public ShapesInterface getGroup() {
        return this.group;
    }

    public void addTriangle() {
        Frame frame = new Frame(this.center.x - 75, this.center.y - 75, 150, 150);
        Random rand = new Random();
        Color strokeColor = new Color(rand.nextInt(0xFFFFFF));
        Color fillColor = new Color(rand.nextInt(0xFFFFFF));
        Triangle shape = new Triangle(frame, strokeColor, fillColor);
        this.group.addShape(shape);
    }

    public void addRectangle() {
        Frame frame = new Frame(this.center.x - 75, this.center.y - 75, 150, 150);
        Random rand = new Random();
        Color strokeColor = new Color(rand.nextInt(0xFFFFFF));
        Color fillColor = new Color(rand.nextInt(0xFFFFFF));
        Rectangle shape = new Rectangle(frame, strokeColor, fillColor);
        this.group.addShape(shape);
    }

    public void addEllipse() {
        Frame frame = new Frame(this.center.x - 75, this.center.y - 75, 150, 150);
        Random rand = new Random();
        Color strokeColor = new Color(rand.nextInt(0xFFFFFF));
        Color fillColor = new Color(rand.nextInt(0xFFFFFF));
        Ellipse shape = new Ellipse(frame, strokeColor, fillColor);
        this.group.addShape(shape);
    }
}
