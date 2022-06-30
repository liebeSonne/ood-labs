package controller.transfer;

import model.Frame;

public class MoveUseCase {

    private Movables movables;

    public MoveUseCase(Movables movables) {
        this.movables = movables;
    }

    public void move(Movable movable, int offsetX, int offsetY) {
        movables.forEach(item -> {
            Frame frame = item.getFrame();
            Frame newFrame = new Frame(frame.getLeft() + offsetX, frame.getTop() + offsetY, frame.getWidth(), frame.getHeight());
            item.setFrame(newFrame);
        });
    }
}
