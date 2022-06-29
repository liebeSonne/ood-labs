package view;

import model.Frame;
import model.Style;
import model.observer.ShapeObserver;

import javax.swing.*;
import java.awt.*;

public class SelectionShapeView extends JComponent implements ShapeObserver {
    private Frame frame;

    public SelectionShapeView(Frame frame) {
        this.frame = frame;
    }

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        Graphics2D g2 = (Graphics2D) g;

        g2.setColor(Color.blue);
        g2.setStroke(new BasicStroke(3));
        g2.drawRect(frame.getLeft(), frame.getTop(), frame.getWidth(), frame.getHeight());
    }

    public void draw(Graphics2D g2) {
        paintComponent(g2);
    }

    @Override
    public void onUpdateStyle(Style style) {

    }

    @Override
    public void onUpdateFrame(Frame frame) {
        this.frame = new Frame(frame.getLeft(), frame.getTop(), frame.getWidth(), frame.getHeight());
        repaint();
    }
}
