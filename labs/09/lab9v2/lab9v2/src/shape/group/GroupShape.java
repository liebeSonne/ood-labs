package shape.group;

import canvas.CanvasInterface;
import enumerator.FillStyleEnumerator;
import enumerator.StrokeStyleEnumerator;
import shape.Frame;
import shape.ShapeInterface;
import style.CompoundStyle;
import style.StyleInterface;

import java.util.ArrayList;
import java.util.Collections;

public class GroupShape implements GroupShapeInterface {
    private ArrayList<ShapeInterface> shapes;
    private StyleInterface fillStyle;
    private StyleInterface strokeStyle;

    public GroupShape() {
        this.shapes = new ArrayList<ShapeInterface>();
        this.fillStyle = new CompoundStyle(new FillStyleEnumerator(this.shapes));
        this.strokeStyle = new CompoundStyle(new StrokeStyleEnumerator(this.shapes));
    }

    @Override
    public Frame getFrame() {
        ArrayList<Integer> xMin = new ArrayList<Integer>();
        ArrayList<Integer> yMin = new ArrayList<Integer>();
        ArrayList<Integer> xMax = new ArrayList<Integer>();
        ArrayList<Integer> yMax = new ArrayList<Integer>();

        this.shapes.forEach(shape -> {
            Frame frame = shape.getFrame();
            if (frame.getWidth() == 0 || frame.getHeight() == 0) {
                return;
            }
            xMin.add(frame.getLeft());
            yMin.add(frame.getTop());
            xMax.add(frame.getLeft() + frame.getWidth());
            yMax.add(frame.getTop() + frame.getHeight());
        });

        int xMinIndex = xMin.indexOf(Collections.min(xMin));
        int yMinIndex = yMin.indexOf(Collections.min(yMin));
        int xMaxIndex = xMax.indexOf(Collections.max(xMax));
        int yMaxIndex = yMax.indexOf(Collections.max(yMax));

        int minX = 0;
        int minY = 0;
        int maxX = 0;
        int maxY = 0;

        if (xMinIndex >= 0) {
            minX = xMin.get(xMinIndex);
        }
        if (yMinIndex >= 0) {
            minY = yMin.get(yMinIndex);
        }
        if (xMaxIndex >= 0) {
            maxX = xMax.get(xMaxIndex);
        }
        if (yMaxIndex >= 0) {
            maxY = yMax.get(yMaxIndex);
        }

        return new Frame(minX, minY, maxX - minX, maxY - minY);
    }

    public void setFrame(Frame frame) {
        Frame groupFrame = this.getFrame();
        int diffLeft = frame.getLeft() - groupFrame.getLeft();
        int diffTop = frame.getTop() - groupFrame.getTop();
        int scaleWidth = groupFrame.getWidth() != 0 ? (int) (frame.getWidth() / getFrame().getWidth()) : 0;
        int scaleHeight = groupFrame.getHeight() != 0 ? (int) (frame.getHeight() / getFrame().getHeight()) : 0;

        this.shapes.forEach(shape -> {
            Frame shapeFrame = shape.getFrame();
            int left = shapeFrame.getLeft() + diffLeft;
            int top = shapeFrame.getTop() + diffTop;
            int width = shapeFrame.getWidth() * scaleWidth;
            int height = shapeFrame.getHeight() * scaleHeight;
            Frame newFrame = new Frame(left, top, width, height);
            shape.setFrame(newFrame);
        });
    }

    @Override
    public StyleInterface getFillStyle() {
        return this.fillStyle;
    }

    @Override
    public StyleInterface getStrokeStyle() {
        return this.strokeStyle;
    }

    public GroupShapeInterface getGroup() { return this; }

    @Override
    public void draw(CanvasInterface canvas) {
        this.shapes.forEach(shape -> shape.draw(canvas));
    }
}
