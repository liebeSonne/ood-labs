package model;

import common.observer.Observable;
import common.observer.Observed;
import common.observer.Observer;
import model.observer.ShapeObserved;
import model.observer.ShapeObserver;

import java.util.ArrayList;

public class Shape implements Observed, Observer, ShapeObserved {
    private Observable observable;
    private ArrayList<ShapeObserver> shapeObservables = new ArrayList<ShapeObserver>();
    private final ShapeType type;
    private Frame frame;
    private final Style style;

    public Shape(ShapeType type, Frame frame, Style style) {
        this.type = type;
        observable = new Observable();
        this.frame = new Frame(frame.getLeft(),frame.getTop(),frame.getWidth(),frame.getHeight());
        this.style = new Style(style.getFillColor(), style.getStrokeColor());
        this.style.registerObserver(this);
    }

    public ShapeType getType() {
        return type;
    }

    public Frame getFrame() {
        return frame;
    }

    public void setFrame(Frame frame) {
        this.frame = new Frame(frame.getLeft(),frame.getTop(),frame.getWidth(),frame.getHeight());
        notifyObservers();
    }

    public Style getStyle() {
        return style;
    }

    private void setStyle(Style style) {
        this.style.setFillColor(style.getFillColor());
        this.style.setStrokeColor(style.getStrokeColor());
    }

    @Override
    public void update() {
        notifyObservers();
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
    public void registerShapeObserver(ShapeObserver observer) {
        shapeObservables.add(observer);
    }
}
