package view;

import model.Frame;
import model.Shape;

import javax.swing.*;
import java.awt.*;

public class SelectionShapeView extends JComponent {
    private final Shape model;

    public SelectionShapeView(Shape shape) {
        this.model = shape;
    }

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        Graphics2D g2 = (Graphics2D) g;

        Frame frame = model.getFrame();

        g2.setColor(Color.blue);
        g2.setStroke(new BasicStroke(3));
        g2.drawRect(frame.getLeft(), frame.getTop(), frame.getWidth(), frame.getHeight());
    }

    public void draw(Graphics2D g2) {
        paintComponent(g2);
    }
}
