package model;

import common.observer.Observable;
import common.observer.Observed;
import common.observer.Observer;

import java.awt.*;

public class Style implements Observed {
    Observable observable;
    private Color fillColor;
    private Color strokeColor;

    public Style(Color fillColor, Color strokeColor) {
        observable = new Observable();
        this.fillColor = fillColor;
        this.strokeColor = strokeColor;
    }

    public Color getStrokeColor() {
        return strokeColor;
    }

    public void setStrokeColor(Color color) {
        if (color == strokeColor) return;
        strokeColor = new Color(color.getRed(), color.getGreen(), color.getBlue(), color.getAlpha());
        notifyObservers();
    }

    public Color getFillColor() {
        return fillColor;
    }

    public void setFillColor(Color color) {
        if (color == fillColor) return;
        fillColor = new Color(color.getRed(), color.getGreen(), color.getBlue(), color.getAlpha());
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
}
