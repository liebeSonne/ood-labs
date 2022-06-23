package view.shape;

import java.awt.*;

public interface ShapeViewInterface {
    public boolean contains(Point point);

    public void draw(Graphics2D g2);
}
