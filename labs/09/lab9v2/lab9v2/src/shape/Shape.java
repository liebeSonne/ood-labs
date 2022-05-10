package shape;

import canvas.CanvasInterface;
import shape.group.GroupShapeInterface;
import style.Style;
import style.StyleInterface;

import java.awt.*;

abstract public class Shape implements ShapeInterface{
    private Frame frame;
    private Style fillStyle;
    private Style strokeStyle;
    public Shape (Frame frame, Color strokeColor, Color fillColor) {
        this.setFrame(frame);
        this.fillStyle = new Style(fillColor);
        this.strokeStyle = new Style(strokeColor);
    }

    public Frame getFrame() {
        return this.frame;
    }

    public void setFrame(Frame frame) {
        this.frame = new Frame(frame.getLeft(), frame.getTop(), frame.getWidth(), frame.getHeight());
    }

    public StyleInterface getFillStyle() {
        return this.fillStyle;
    }

    public StyleInterface getStrokeStyle() {
        return this.strokeStyle;
    }

    public GroupShapeInterface getGroup() { return null; }

    @Override
    abstract public void draw(CanvasInterface canvas);
}
