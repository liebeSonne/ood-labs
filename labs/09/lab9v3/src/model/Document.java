package model;

import common.observer.Observable;
import common.observer.Observed;
import common.observer.Observer;

import java.util.ArrayList;
import java.util.function.Consumer;

public class Document implements Observed, Observer {
    Observable observable;
    ArrayList<Shape> shapes;

    public Document() {
        observable = new Observable();
        shapes = new ArrayList<Shape>();
    }

    @Override
    public void update() {
        notifyObservers();
    }

    public void addShape(Shape shape) {
        shapes.add(shape);
        shape.registerObserver(this);
        notifyObservers();
    }

    public void removeShape(Shape shape) {
        shapes.remove(shape);
        notifyObservers();
    }

    public void forEach(Consumer<? super Shape> action) {
        shapes.forEach(action);
    }

    @Override
    public void registerObserver(Observer observer) {
        observable.registerObserver(observer);
    }

    @Override
    public void notifyObservers() {
        observable.notifyObservers();
    }
}
