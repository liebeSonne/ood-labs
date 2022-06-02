package view;

import canvas.CanvasInterface;
import canvas.GraphicsCanvas;
import controller.CanvasController;
import observer.ObserverInterface;

import javax.swing.*;
import java.awt.*;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.awt.event.MouseMotionAdapter;

public class CanvasView extends JPanel implements CanvasDataVIewInterface, ObserverInterface {
    private final CanvasController controller;

    public CanvasView(CanvasController controller) {
        super();
        System.out.println("CanvasView");

        this.controller = controller;

        this.bindMouseListener();
    }

    @Override
    public CanvasInterface getCanvas() {
        Graphics2D g2 = (Graphics2D) this.getGraphics();
        return new GraphicsCanvas(g2);
    }

    @Override
    public void paintComponent(Graphics g) {
        super.paintComponent(g);
        Graphics2D g2 = (Graphics2D) g;

        g2.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);

        this.controller.onDraw();
    }

    private void bindMouseListener() {
        System.out.println("canvasView::bindMouseListener");
        this.addMouseListener(new MouseAdapter() {
            @Override
            public void mousePressed(MouseEvent e) {
                super.mousePressed(e);
                System.out.println("canvasView::mousePressed");
                controller.onClick(e.getPoint());
            }

            @Override
            public void mouseReleased(MouseEvent e) {
                super.mouseReleased(e);
                System.out.println("canvasView::mouseReleased");
                setCursor(Cursor.getPredefinedCursor(Cursor.getDefaultCursor().getType()));
                controller.onEndDraggable();
            }
        });

        this.addMouseMotionListener(new MouseMotionAdapter() {
            @Override
            public void mouseDragged(MouseEvent e) {
                super.mouseDragged(e);
                System.out.println("canvasView::mouseDragged");
                setCursor(Cursor.getPredefinedCursor(Cursor.HAND_CURSOR));
                controller.onDraggable(e.getPoint());
            }
//
//            @Override
//            public void mouseMoved(MouseEvent e) {
//                super.mouseMoved(e);
//                System.out.println("mouseMoved: " + e.getPoint());
//            }

        });
    }

    public void update() {
        System.out.println("CanvasView::update");
        this.redraw();
    }

    public void redraw() {
        System.out.println("CanvasView::redraw");
        this.paintComponent(this.getGraphics());
    }
}
