package view.shape;

import controller.ShapeController;
import model.Frame;
import model.Shape;

import java.awt.*;

public class RectangleVIew extends ShapeView {
    public RectangleVIew(Shape shape, ShapeController controller) {
        super(shape, controller);
    }

    @Override
    public boolean contains(Point point) {
//        Frame frame = this.shape.getFrame();
        Frame frame = this.frame;
        int minX = frame.getLeft();
        int minY = frame.getTop();
        int maxX = frame.getLeft() + frame.getWidth();
        int maxY = frame.getTop() + frame.getHeight();

        return point.x >= minX && point.x <= maxX && point.y >= minY && point.y <= maxY;
    }

    @Override
    public void draw(Graphics2D g2) {
        Point[] points = this.createPoints();
        Polygon polygon = this.createPolygon(points);

        g2.setColor(this.shape.getStyle().getFillColor());
        g2.fill(polygon);

        int lineSize = 3;

        g2.setColor(this.shape.getStyle().getStrokeColor());
        g2.setStroke(new BasicStroke(lineSize));
        g2.draw(polygon);

        // @TODO - if is selected - draw frame
    }


    private Point[] createPoints() {
//        Frame frame = this.shape.getFrame();
        Frame frame = this.frame;
        Point[] points = {
                new Point(frame.getLeft(), frame.getTop()),
                new Point(frame.getLeft() + frame.getWidth(), frame.getTop()),
                new Point(frame.getLeft() + frame.getWidth(), frame.getTop() + frame.getHeight()),
                new Point(frame.getLeft(), frame.getTop() + frame.getHeight()),
        };
        return points;
    }

    private Polygon createPolygon(Point[] points) {
        int[] xList = new int[points.length];
        int[] yList = new int[points.length];

        for (int i = 0; i < points.length; i++) {
            xList[i] = points[i].x;
            yList[i] = points[i].y;

        }

        return new Polygon(xList, yList, points.length);
    }
}
