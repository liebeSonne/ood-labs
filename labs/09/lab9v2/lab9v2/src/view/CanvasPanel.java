package view;

import canvas.GraphicsCanvas;
import document.DocumentInterface;
import shape.ShapeInterface;

import javax.swing.*;
import java.awt.*;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.awt.event.MouseMotionAdapter;

public class CanvasPanel extends JPanel {
    private DocumentInterface document;

    private ShapeInterface selectedShape;

    public CanvasPanel() {
        super();
        this.bindMouseListener();
    }

    public void setDocument(DocumentInterface document) {
        this.document = document;
    }

    @Override
    public void paintComponents(Graphics g) {
        super.paintComponents(g);
        Graphics2D g2 = (Graphics2D) g;

        g2.clearRect(0,0,getWidth(), getHeight());

        if (this.document != null) {
            GraphicsCanvas canvas = new GraphicsCanvas(g2);
            this.document.getShapes().forEach(shape -> {
                shape.draw(canvas);
            });
            if (this.selectedShape != null) {
                this.selectedShape.drawFrame(canvas);
            }
        }
    }

    private void redraw() {
        this.paintComponents(this.getGraphics());
    }

    private void selectShape(Point point) {
        this.selectedShape = null;
        this.document.getShapes().forEach(shape -> {
            if (shape.contains(point)) {
                selectedShape = shape;
            }
        });
        System.out.println("selectShape: " + this.selectedShape);
        this.redraw();
    }

    private void bindMouseListener() {
        this.addMouseListener(new MouseAdapter() {
            @Override
            public void mousePressed(MouseEvent e) {
                super.mousePressed(e);
                System.out.println("mousePressed: " + e.getPoint());
                selectShape(e.getPoint());
            }

            @Override
            public void mouseReleased(MouseEvent e) {
                super.mouseReleased(e);
                System.out.println("mouseReleased: " + e.getPoint());
                setCursor(Cursor.getPredefinedCursor(Cursor.getDefaultCursor().getType()));
            }
        });

        this.addMouseMotionListener(new MouseMotionAdapter() {
            @Override
            public void mouseDragged(MouseEvent e) {
            super.mouseDragged(e);
            System.out.println("mouseDragged: " + e.getPoint());
            setCursor(Cursor.getPredefinedCursor(Cursor.HAND_CURSOR));
            }
//
//            @Override
//            public void mouseMoved(MouseEvent e) {
//                super.mouseMoved(e);
//                System.out.println("mouseMoved: " + e.getPoint());
//            }

        });
    }
}
