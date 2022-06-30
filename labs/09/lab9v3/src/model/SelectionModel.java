package model;

import common.observer.Observed;
import common.observer.Observer;
import model.Shape;
import model.observer.DocumentObserver;

import java.util.ArrayList;
import java.util.function.Consumer;

public class SelectionModel implements DocumentObserver, Observed {

    private final ArrayList<Shape> selected = new ArrayList<Shape>();
    private final ArrayList<Observer> observers = new ArrayList<Observer>();

    public SelectionModel() {

    }

    public void selected(Shape shape) {
        selected.add(shape);
        notifyObservers();
    }

    public void unselected(Shape shape) {
        selected.remove(shape);
        notifyObservers();
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
        notifyObservers();
    }

    @Override
    public void onUpdateShape(Shape shape) {

    }

    @Override
    public void registerObserver(Observer observer) {
        observers.add(observer);
    }

    @Override
    public void notifyObservers() {
        observers.forEach(Observer::update);
    }
}
