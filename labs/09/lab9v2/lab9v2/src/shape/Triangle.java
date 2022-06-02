package shape;

import canvas.CanvasInterface;

import java.awt.*;

public class Triangle extends Shape {
    public Triangle(Frame frame, Color strokeColor, Color fillColor) {
        super(frame, strokeColor, fillColor);
    }

    @Override
    public void draw(CanvasInterface canvas) {
        Frame frame = this.getFrame();
        Point[] points = {
            new Point(frame.getLeft(), frame.getTop()+frame.getHeight()),
            new Point(frame.getLeft()+frame.getWidth(), frame.getTop()+frame.getHeight()),
            new Point(frame.getLeft()+frame.getWidth()/2,frame.getTop()),
        };
        canvas.fillPolygon(points, this.getFillStyle().getColor());
        canvas.setColor(this.getStrokeStyle().getColor());
        canvas.setLineSize(3);
        canvas.drawPolygon(points);

        if (this.isSelected()) {
            this.drawFrame(canvas);
        }
    }

    @Override
    public boolean contains(Point point) {
        Frame frame = this.getFrame();
        Point p1 = new Point(frame.getLeft(), frame.getTop()+frame.getHeight());
        Point p2 = new Point(frame.getLeft()+frame.getWidth(), frame.getTop()+frame.getHeight());
        Point p3 = new Point(frame.getLeft()+frame.getWidth()/2,frame.getTop());

        int a = (p1.x - point.x) * (p2.y - p1.y) - (p2.x - p1.x) * (p1.y - point.y);
        int b = (p2.x - point.x) * (p3.y - p2.y) - (p3.x - p2.x) * (p2.y - point.y);
        int c = (p3.x - point.x) * (p1.y - p3.y) - (p1.x - p3.x) * (p3.y - point.y);

        return (a>= 0 && b >= 0 && c >= 0) || (a <= 0 && b <= 0 && c <= 0);
    }
}
