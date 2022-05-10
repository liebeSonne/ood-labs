package canvas;

import java.awt.*;

public interface CanvasInterface {
    public void setLineSize(int size);
    public void setColor(Color color);
    public void drawLine(int xFrom, int yFrom, int xTo, int yTo);
    public void drawEllipse(int xLeft, int yTop, int width, int height);
    public void fillEllipse(int xLeft, int yTop, int width, int height, Color color);
    public void drawPolygon(Point[] points);
    public void fillPolygon(Point[] points, Color color);
}
