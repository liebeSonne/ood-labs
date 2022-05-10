package canvas;

import java.awt.*;
import java.awt.geom.Ellipse2D;

public class GraphicsCanvas implements CanvasInterface {
    private Graphics2D g;
    private int lineSize;
    private Color color;

    public GraphicsCanvas(Graphics2D g) {
        this.g = g;
        this.lineSize = 1;
        this.color = new Color(0,0,0);
    }

    @Override
    public void setLineSize(int size) {
        this.lineSize = size;
    }

    @Override
    public void setColor(Color color) {
        this.color = color;
    }

    @Override
    public void drawLine(int xFrom, int yFrom, int xTo, int yTo) {
        this.setStrokeColor();
        this.g.drawLine(xFrom, yFrom, xTo, yTo);
    }

    @Override
    public void drawEllipse(int xLeft, int yTop, int width, int height) {
        Ellipse2D ellipse = new Ellipse2D.Double(xLeft, yTop, width, height);
        this.setStrokeColor();
        this.g.draw(ellipse);
    }

    @Override
    public void fillEllipse(int xLeft, int yTop, int width, int height, Color color) {
        Ellipse2D ellipse = new Ellipse2D.Double(xLeft, yTop, width, height);
        this.g.setColor(color);
        this.g.fill(ellipse);
    }

    @Override
    public void drawPolygon(Point[] points) {
        Polygon polygon = this.createPolygon(points);
        this.setStrokeColor();
        this.g.draw(polygon);
    }

    @Override
    public void fillPolygon(Point[] points, Color color) {
        Polygon polygon = this.createPolygon(points);
        this.setColor(color);
        this.g.fill(polygon);
    }

    private void setStrokeColor() {
        this.g.setColor(this.color);
        this.g.setStroke(new BasicStroke(this.lineSize));
    }

    private Polygon createPolygon(Point[] points) {
        int[] xList = new int[points.length];
        int[] yList = new int[points.length];

        for (int i = 0; i < points.length; i++) {
            xList[i] = points[i].x;
            yList[i] = points[i].y;

        }

        Polygon polygon = new Polygon(xList, yList, points.length);
        return polygon;
    }
}
