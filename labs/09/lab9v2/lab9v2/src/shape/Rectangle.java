package shape;

import canvas.CanvasInterface;

import java.awt.*;

public class Rectangle extends Shape {
    public Rectangle(Frame frame, Color strokeColor, Color fillColor) {
        super(frame, strokeColor, fillColor);
    }

    @Override
    public void draw(CanvasInterface canvas) {
        Frame frame = this.getFrame();
        Point[] points = {
            new Point(frame.getLeft(), frame.getTop()),
            new Point(frame.getLeft() + frame.getWidth(), frame.getTop()),
            new Point(frame.getLeft() + frame.getWidth(), frame.getTop() + frame.getHeight()),
            new Point(frame.getLeft(), frame.getTop() + frame.getHeight()),
        };
        canvas.fillPolygon(points, this.getFillStyle().getColor());
        canvas.setLineSize(3);
        canvas.setColor(this.getStrokeStyle().getColor());
        canvas.drawPolygon(points);
    }

    public boolean contains(Point point) {
        Frame frame = this.getFrame();
        int minX = frame.getLeft();
        int minY = frame.getTop();
        int maxX = frame.getLeft() + frame.getWidth();
        int maxY = frame.getTop() + frame.getHeight();

        return point.x >= minX && point.x <= maxX && point.y >= minY && point.y <= maxY;
    }

}
