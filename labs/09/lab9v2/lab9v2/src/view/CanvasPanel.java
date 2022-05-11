package view;

import canvas.DrawableInterface;
import canvas.GraphicsCanvas;

import javax.swing.*;
import java.awt.*;

public class CanvasPanel extends JPanel {

    private DrawableInterface group;

    public CanvasPanel() {
    }

    public void setGroup(DrawableInterface group) {
        this.group = group;
    }

    @Override
    public void paintComponents(Graphics g) {
        super.paintComponents(g);
        Graphics2D g2 = (Graphics2D) g;

        if (this.group != null) {
            GraphicsCanvas canvas = new GraphicsCanvas(g2);
            this.group.draw(canvas);
        }
    }
}
