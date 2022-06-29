package view.shape;

import controller.ShapeController;
import model.Frame;
import model.Shape;

import java.awt.*;

public class TriangleView extends ShapeView {
    public TriangleView(Shape shape, ShapeController controller) {
        super(shape, controller);
    }

    @Override
    public boolean contains(Point point) {
//        Frame frame = this.shape.getFrame();
        Frame frame = this.frame;
        Point p1 = new Point(frame.getLeft(), frame.getTop()+frame.getHeight());
        Point p2 = new Point(frame.getLeft()+frame.getWidth(), frame.getTop()+frame.getHeight());
        Point p3 = new Point(frame.getLeft()+frame.getWidth()/2,frame.getTop());

        int a = (p1.x - point.x) * (p2.y - p1.y) - (p2.x - p1.x) * (p1.y - point.y);
        int b = (p2.x - point.x) * (p3.y - p2.y) - (p3.x - p2.x) * (p2.y - point.y);
        int c = (p3.x - point.x) * (p1.y - p3.y) - (p1.x - p3.x) * (p3.y - point.y);

        return (a>= 0 && b >= 0 && c >= 0) || (a <= 0 && b <= 0 && c <= 0);
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
                new Point(frame.getLeft(), frame.getTop()+frame.getHeight()),
                new Point(frame.getLeft()+frame.getWidth(), frame.getTop()+frame.getHeight()),
                new Point(frame.getLeft()+frame.getWidth()/2,frame.getTop()),
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
