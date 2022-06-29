package view.model;

import model.Shape;
import model.observer.DocumentObserver;

import java.util.ArrayList;
import java.util.function.Consumer;

public class SelectionModel implements DocumentObserver {

    private final ArrayList<Shape> selected = new ArrayList<Shape>();

    public SelectionModel() {

    }

    public void selected(Shape shape) {
        selected.add(shape);
    }

    public void unselected(Shape shape) {
        selected.remove(shape);
    }

    public boolean isSelected(Shape shape) {
        return selected.contains(shape);
    }

    public void forEach(Consumer<? super Shape> action) {
        selected.forEach(action);
    }

    @Override
    public void onAddShape(Shape shape) {

    }

    @Override
    public void onRemoveShape(Shape shape) {
        selected.remove(shape);
    }

    @Override
    public void onUpdateShape(Shape shape) {

    }

}
