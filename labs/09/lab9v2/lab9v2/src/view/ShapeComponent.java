package view;

import canvas.DrawableInterface;
import canvas.GraphicsCanvas;

import javax.swing.*;
import java.awt.*;

public class ShapeComponent extends JComponent {
    DrawableInterface shape;

    public ShapeComponent(DrawableInterface shape) {
        super();
        this.shape = shape;
    }

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        Graphics2D g2 = (Graphics2D) g;

        GraphicsCanvas canvas = new GraphicsCanvas(g2);

        shape.draw(canvas);
    }
}
