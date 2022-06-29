package model.observer;

import model.Shape;

public interface DocumentObserver {
    public void onAddShape(Shape shape);
    public void onRemoveShape(Shape shape);
    public void onUpdateShape(Shape shape);
}
