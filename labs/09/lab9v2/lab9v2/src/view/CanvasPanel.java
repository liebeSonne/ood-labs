package view;

import canvas.GraphicsCanvas;
import document.DocumentInterface;
import shape.Frame;
import shape.ShapeInterface;

import javax.swing.*;
import java.awt.*;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.awt.event.MouseMotionAdapter;

public class CanvasPanel extends JPanel {
    private DocumentInterface document;

    private ShapeInterface selectedShape;

    private Point selectedPoint;

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

    private void setSelectedPoint(Point point) {
        if (selectedShape != null && selectedShape.contains(point)) {
            selectedPoint = point;
        } else {
            selectedPoint = null;
        }
    }

    private void moveSelectedTo(Point point) {
        if (selectedShape != null && selectedPoint != null) {
            if (selectedShape.contains(point)) {
                Frame frame = selectedShape.getFrame();
                int diffX = (point.x - selectedPoint.x);
                int diffY = (point.y - selectedPoint.y);
                int x = frame.getLeft() + diffX;
                int y = frame.getTop() + diffY;
                Point to = new Point(x, y);
                selectedShape.moveTo(to);
                System.out.println("moveSelected: on " + point + " From (" + frame.getLeft() + ", " + frame.getTop() + ") to " + to + " diff: [" + diffX + ", " + diffY + "]");
                redraw();
            }
        }
    }

    private void bindMouseListener() {
        this.addMouseListener(new MouseAdapter() {
            @Override
            public void mousePressed(MouseEvent e) {
                super.mousePressed(e);
                System.out.println("mousePressed: " + e.getPoint());
                selectShape(e.getPoint());
                setSelectedPoint(e.getPoint());
                System.out.println("mousePressed:selectedPoint: " + selectedPoint);
            }

            @Override
            public void mouseReleased(MouseEvent e) {
                super.mouseReleased(e);
                System.out.println("mouseReleased: " + e.getPoint());
                setCursor(Cursor.getPredefinedCursor(Cursor.getDefaultCursor().getType()));
                selectedPoint = null;
                System.out.println("mouseReleased:selectedPoint: " + selectedPoint);
            }
        });

        this.addMouseMotionListener(new MouseMotionAdapter() {
            @Override
            public void mouseDragged(MouseEvent e) {
                super.mouseDragged(e);
//                System.out.println("mouseDragged: " + e.getPoint());
                setCursor(Cursor.getPredefinedCursor(Cursor.HAND_CURSOR));
                moveSelectedTo(e.getPoint());
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
