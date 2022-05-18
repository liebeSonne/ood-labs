package controller;

import document.DocumentInterface;
import shape.*;
import shape.Frame;
import shape.Rectangle;
import java.util.Random;

import java.awt.*;

public class ShapeController implements ShapeControllerInterface {

    Point center;
    DocumentInterface document;

    public ShapeController(Point center, DocumentInterface document) {
        this.center = new Point(center.x, center.y);
        this.document = document;
    }

    public void addTriangle() {
        Frame frame = new Frame(this.center.x - 75, this.center.y - 75, 150, 150);
        Random rand = new Random();
        Color strokeColor = new Color(rand.nextInt(0xFFFFFF));
        Color fillColor = new Color(rand.nextInt(0xFFFFFF));
        Triangle shape = new Triangle(frame, strokeColor, fillColor);
        this.document.addShape(shape);
    }

    public void addRectangle() {
        Frame frame = new Frame(this.center.x - 75, this.center.y - 75, 150, 150);
        Random rand = new Random();
        Color strokeColor = new Color(rand.nextInt(0xFFFFFF));
        Color fillColor = new Color(rand.nextInt(0xFFFFFF));
        Rectangle shape = new Rectangle(frame, strokeColor, fillColor);
        this.document.addShape(shape);
    }

    public void addEllipse() {
        Frame frame = new Frame(this.center.x - 95, this.center.y - 75, 190, 150);
        Random rand = new Random();
        Color strokeColor = new Color(rand.nextInt(0xFFFFFF));
        Color fillColor = new Color(rand.nextInt(0xFFFFFF));
        Ellipse shape = new Ellipse(frame, strokeColor, fillColor);
        this.document.addShape(shape);
    }
}
