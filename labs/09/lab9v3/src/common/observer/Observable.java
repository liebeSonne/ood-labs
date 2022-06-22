package common.observer;

import java.util.ArrayList;

public class Observable implements Observed {
    ArrayList<Observer> observers;

    public Observable() {
        observers = new ArrayList<Observer>();
    }
    @Override
    public void registerObserver(Observer observer) {
        observers.add(observer);
    }

    public void notifyObservers() {
        observers.forEach(Observer::update);
    }
}
