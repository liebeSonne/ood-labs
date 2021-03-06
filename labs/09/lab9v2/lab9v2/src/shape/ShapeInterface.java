package shape;

import canvas.DrawableInterface;
import style.StyleInterface;

import java.awt.*;

public interface ShapeInterface extends DrawableInterface {
    public Frame getFrame();
    public void setFrame(Frame frame);
    public StyleInterface getFillStyle();
    public StyleInterface getStrokeStyle();

    public boolean isSelected();
    public void setSelected(boolean selected);

    public boolean contains(Point point);
    public void moveTo(Point point);
    public void translate(int x, int y);
}
