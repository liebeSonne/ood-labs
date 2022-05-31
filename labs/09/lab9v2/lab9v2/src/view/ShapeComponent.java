package view;

import canvas.GraphicsCanvas;
import shape.ShapeInterface;

import javax.swing.*;
import java.awt.*;

public class ShapeComponent extends JComponent {
    ShapeInterface shape;

    public ShapeComponent(ShapeInterface shape) {
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
