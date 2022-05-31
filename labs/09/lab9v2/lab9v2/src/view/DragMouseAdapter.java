package view;

import controller.MainControllerInterface;
import shape.ShapeInterface;

import java.awt.*;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

public class DragMouseAdapter extends MouseAdapter {

    Point selectedPoint;
    ShapeInterface shape;
    MainControllerInterface controller;

    public DragMouseAdapter(MainControllerInterface controller) {
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
