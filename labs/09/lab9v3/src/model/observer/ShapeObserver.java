package model.observer;

import model.Frame;
import model.Style;

public interface ShapeObserver {
    public void onUpdateStyle(Style style);
    public void onUpdateFrame(Frame frame);
}
