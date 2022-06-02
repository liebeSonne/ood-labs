package controller;

import document.DocumentInterface;
import shape.*;
import shape.Frame;
import shape.Rectangle;
import view.ShapeDataViewInterface;

import java.awt.*;
import java.util.Random;

public class ShapeController {
    DocumentInterface document;

    ShapeDataViewInterface view;

    public ShapeController(DocumentInterface document, ShapeDataViewInterface view) {
        this.document = document;
        this.view = view;
    }

    public void onAddShape(ShapeType type) {
        System.out.println("onAddShape");
        switch (type) {
            case ELLIPSE -> { this.addEllipse(); break; }
            case TRIANGLE -> { this.addTriangle(); break; }
            case RECTANGLE -> { this.addRectangle(); break; }
        }
    }

    private Color getRandomColor() {
        Random rand = new Random();
        return new Color(rand.nextInt(0xFFFFFF));
    }

    private void addTriangle() {
        Point center = this.view.getCenter();
        Frame frame = new Frame(center.x - 75, center.y - 75, 150, 150);
        Color strokeColor = this.getRandomColor();
        Color fillColor = this.getRandomColor();
        Triangle shape = new Triangle(frame, strokeColor, fillColor);
        this.document.addShape(shape);
    }

    private void addRectangle() {
        Point center = this.view.getCenter();
        Frame frame = new Frame(center.x - 75, center.y - 75, 150, 150);
        Color strokeColor = this.getRandomColor();
        Color fillColor = this.getRandomColor();
        shape.Rectangle shape = new Rectangle(frame, strokeColor, fillColor);
        this.document.addShape(shape);
    }

    private void addEllipse() {
        Point center = this.view.getCenter();
        Frame frame = new Frame(center.x - 95, center.y - 75, 190, 150);
        Color strokeColor = this.getRandomColor();
        Color fillColor = this.getRandomColor();
        Ellipse shape = new Ellipse(frame, strokeColor, fillColor);
        this.document.addShape(shape);
    }
}
