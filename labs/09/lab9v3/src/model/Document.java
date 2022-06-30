package model;

import common.observer.Observable;
import common.observer.Observed;
import common.observer.Observer;
import model.observer.DocumentObserved;
import model.observer.DocumentObserver;

import java.util.ArrayList;
import java.util.function.Consumer;

public class Document implements Observed, Observer, DocumentObserved {
    private ArrayList<Shape> shapes = new ArrayList<Shape>();

    private ArrayList<Observer> observers = new ArrayList<Observer>();
    private ArrayList<DocumentObserver> documentObservers = new ArrayList<DocumentObserver>();

    public Document() {

    }

    @Override
    public void update() {
        System.out.println("Document::update");
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

    public int getIndex(Shape shape) {
        return shapes.indexOf(shape);
    }

    @Override
    public void registerObserver(Observer observer) {
        observers.add(observer);
    }

    @Override
    public void notifyObservers() {
        observers.forEach(Observer::update);
    }

    @Override
    public void registerDocumentObserver(DocumentObserver observer) {
        documentObservers.add(observer);
    }
}
