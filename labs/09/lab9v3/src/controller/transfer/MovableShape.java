package controller.transfer;

import model.Frame;
import model.Shape;

public class MovableShape implements Movable{
    private Shape shape;

    public MovableShape(Shape shape) {
        this.shape = shape;
    }

    @Override
    public Frame getFrame() {
        return this.shape.getFrame();
    }

    @Override
    public void setFrame(Frame frame) {
        this.shape.setFrame(frame);
    }
}
