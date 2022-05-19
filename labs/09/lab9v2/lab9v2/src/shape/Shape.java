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

    public void drawFrame(CanvasInterface canvas) {
        Frame frame = this.getFrame();
        Point plt = new Point(frame.getLeft(), frame.getTop());
        Point prt = new Point(frame.getLeft() + frame.getWidth(), frame.getTop());
        Point prb = new Point(frame.getLeft() + frame.getWidth(), frame.getTop() + frame.getHeight());
        Point plb = new Point(frame.getLeft(), frame.getTop() + frame.getHeight());
        Point[] points = {
           plt, prt, prb, plb
        };
        canvas.setLineSize(2);
        canvas.setColor(Color.blue);
        canvas.drawPolygon(points);

        int r = 4;
        for (int i = 0; i < points.length; i++) {
            int px = points[i].x;
            int py = points[i].y;
            canvas.fillEllipse(px-r,py-r,r*2, r*2, new Color(0,0,255, 70));
            canvas.drawEllipse(px-r,py-r,r*2, r*2);
        }
    }

    @Override
    abstract public boolean contains(Point point);

    public void moveTo(Point point) {
        Frame frame = this.getFrame();
        this.setFrame(new Frame(point.x, point.y, frame.getWidth(), frame.getHeight()));
    }
}
