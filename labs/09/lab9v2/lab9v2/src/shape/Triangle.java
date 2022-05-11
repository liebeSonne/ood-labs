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
    }
}
