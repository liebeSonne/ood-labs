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
}
