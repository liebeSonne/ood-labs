package shape;

import canvas.CanvasInterface;

import java.awt.*;

public class Ellipse extends Shape {
    public Ellipse(Frame frame, Color strokeColor, Color fillColor) {
        super(frame, strokeColor, fillColor);
    }

    @Override
    public void draw(CanvasInterface canvas) {
        Frame frame = this.getFrame();
        canvas.fillEllipse(frame.getLeft(), frame.getTop(), frame.getWidth(), frame.getHeight(), this.getFillStyle().getColor());
        canvas.setLineSize(3);
        canvas.setColor(this.getStrokeStyle().getColor());
        canvas.drawEllipse(frame.getLeft(), frame.getTop(), frame.getWidth(), frame.getHeight());
    }

    @Override
    public boolean contains(Point point) {
        Frame frame = this.getFrame();
        Point center = new Point(frame.getLeft() + frame.getWidth() / 2, frame.getTop() + frame.getHeight() / 2);
        double x2 = Math.pow(point.x - center.x, 2);
        double y2 = Math.pow(point.y - center.y, 2);
        double w2 = Math.pow(frame.getWidth() / 2, 2);
        double h2 = Math.pow(frame.getHeight() / 2, 2);

        return x2 / w2 + y2 / h2 <= 1;
    }
}
