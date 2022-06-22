package common.observer;

public interface Observed {
    public void registerObserver(Observer observer);
    public void notifyObservers();
}
