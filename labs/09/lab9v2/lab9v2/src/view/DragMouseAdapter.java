package view;

import canvas.DrawableInterface;
import controller.ShapeControllerInterface;

import java.awt.*;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

public class DragMouseAdapter extends MouseAdapter {

    Point selectedPoint;
    DrawableInterface shape;
    ShapeControllerInterface controller;

    public DragMouseAdapter(ShapeControllerInterface controller) {
        super();
        this.controller = controller;
    }

    public void mousePressed(MouseEvent e) {
        System.out.println("mousePressed: " + e.getPoint());
        selectedPoint = e.getPoint();
    }

    public void mouseReleased(MouseEvent e) {
        System.out.println("mouseReleased: " + e.getPoint());
        selectedPoint = null;

    }

    public void mouseDragged(MouseEvent e) {
        System.out.println("mouseDragged: " + e.getPoint());
    }
}
