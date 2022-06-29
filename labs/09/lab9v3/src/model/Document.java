package model;

import common.observer.Observable;
import common.observer.Observed;
import common.observer.Observer;
import model.observer.DocumentObserved;
import model.observer.DocumentObserver;

import java.util.ArrayList;
import java.util.function.Consumer;

public class Document implements Observed, Observer, DocumentObserved {
    private Observable observable;
    private ArrayList<Shape> shapes;
    private ArrayList<DocumentObserver> documentObservers;

    public Document() {
        observable = new Observable();
        shapes = new ArrayList<Shape>();
        documentObservers = new ArrayList<DocumentObserver>();
    }

    @Override
    public void update() {
        notifyObservers();
    }

    public void addShape(Shape shape) {
        System.out.println("Document::addShape");
        shapes.add(shape);
        shape.registerObserver(this);
        notifyObservers();
        documentObservers.forEach(observer -> observer.onAddShape(shape));
    }

    public void removeShape(Shape shape) {
        System.out.println("Document::removeShape");
        shapes.remove(shape);
        notifyObservers();
        documentObservers.forEach(observer -> observer.onRemoveShape(shape));
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

    @Override
    public void registerDocumentObserver(DocumentObserver observer) {
        documentObservers.add(observer);
    }
}
