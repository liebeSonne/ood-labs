package view.shape;

import controller.ShapeController;

import model.Frame;
import model.Shape;
import model.Style;
import model.observer.ShapeObserved;
import model.observer.ShapeObserver;

import javax.swing.*;
import java.awt.*;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.awt.event.MouseMotionAdapter;
import java.util.ArrayList;


public abstract class ShapeView extends JComponent implements ShapeViewInterface, ShapeObserver, ShapeObserved {
    protected ShapeController controller;
    protected Shape shape;
    protected Frame frame;

    private final ArrayList<ShapeObserver> shapeObservers = new ArrayList<ShapeObserver>();

    private Point startDraggablePoint;

    public ShapeView(Shape shape, ShapeController controller) {
        super();
        this.shape = shape;
        this.controller = controller;
        Frame frame = shape.getFrame();
        this.frame = new Frame(frame.getLeft(), frame.getTop(), frame.getWidth(), frame.getHeight());
        this.shape.registerShapeObserver(this);

        this.bindMouseListener();
    }

    @Override
    public abstract boolean contains(Point point);

    public abstract void draw(Graphics2D g2);

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        Graphics2D g2 = (Graphics2D) g;
        this.draw(g2);
    }

    @Override
    public boolean contains(int x, int y) {
        return contains(new Point(x, y));
    }

    public void onUpdateStyle(Style style) {
        this.shapeObservers.forEach(observer -> observer.onUpdateStyle(style));
        repaint();
    }

    public void onUpdateFrame(Frame frame) {
        System.out.println("ShapeView::onUpdateFrame()");
        this.frame = new Frame(frame.getLeft(), frame.getTop(), frame.getWidth(), frame.getHeight());
        this.shapeObservers.forEach(observer -> observer.onUpdateFrame(frame));
        repaint();
    }

    public Frame getFrame() {
        return this.frame;
    }

    public void setFrame(Frame frame) {
        Frame newFrame = new Frame(frame.getLeft(), frame.getTop(), frame.getWidth(), frame.getHeight());
        this.frame = newFrame;
        this.shapeObservers.forEach(observer -> observer.onUpdateFrame(frame));
        repaint();
    }

    public void registerShapeObserver(ShapeObserver observer) {
        shapeObservers.add(observer);
    }

    private void bindMouseListener() {
        System.out.println("ShapeView::bindMouseListener");
        this.addMouseListener(new MouseAdapter() {
            @Override
            public void mousePressed(MouseEvent e) {
                super.mousePressed(e);
                System.out.println("ShapeView::mousePressed - " + e.getPoint());
                controller.onSelect();
                startDraggablePoint = e.getPoint();
            }

            @Override
            public void mouseReleased(MouseEvent e) {
                super.mouseReleased(e);
                System.out.println("canvasView::mouseReleased - " + e.getPoint());
                setCursor(Cursor.getPredefinedCursor(Cursor.getDefaultCursor().getType()));
                if (startDraggablePoint != null) {
                    controller.onMove();
                }
                startDraggablePoint = null;
            }
        });

        this.addMouseMotionListener(new MouseMotionAdapter() {
            @Override
            public void mouseDragged(MouseEvent e) {
                super.mouseDragged(e);
                System.out.println("canvasView::mouseDragged - " + e.getPoint());
                setCursor(Cursor.getPredefinedCursor(Cursor.HAND_CURSOR));

                if (startDraggablePoint != null) {
                    Point oldPont = startDraggablePoint;
                    Point newPoint = e.getPoint();

                    int offsetX = newPoint.x - oldPont.x;
                    int offsetY = newPoint.y - oldPont.y;

                    controller.onDraggable(offsetX, offsetY);
                    startDraggablePoint = newPoint;
                }
            }
        });
    }

}
