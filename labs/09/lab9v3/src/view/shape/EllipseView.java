package view.shape;

import model.Frame;
import model.Shape;

import java.awt.*;
import java.awt.geom.Ellipse2D;

public class EllipseView extends ShapeView {
    public EllipseView(Shape shape) {
        super(shape);
    }

    @Override
    public boolean contains(Point point) {
        Frame frame = this.shape.getFrame();
        Point center = new Point(frame.getLeft() + frame.getWidth() / 2, frame.getTop() + frame.getHeight() / 2);
        double x2 = Math.pow(point.x - center.x, 2);
        double y2 = Math.pow(point.y - center.y, 2);
        double w2 = Math.pow(frame.getWidth() / 2, 2);
        double h2 = Math.pow(frame.getHeight() / 2, 2);

        return x2 / w2 + y2 / h2 <= 1;
    }

    @Override
    public void draw(Graphics2D g2) {
        Frame frame = this.shape.getFrame();

        Ellipse2D ellipse = new Ellipse2D.Double(frame.getLeft(), frame.getTop(), frame.getWidth(), frame.getHeight());
        g2.setColor(this.shape.getStyle().getFillColor());
        g2.fill(ellipse);

        int listSize = 3;

        g2.setColor(this.shape.getStyle().getStrokeColor());
        g2.setStroke(new BasicStroke(listSize));
        g2.draw(ellipse);

        // @TODO - if is selected - draw frame
    }
}
