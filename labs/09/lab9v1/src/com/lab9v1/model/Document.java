package com.lab9v1.model;

import java.util.ArrayList;

public class Document implements ImmutableDocument {
    private ArrayList<Harmonica> harmonics;
    private ArrayList<DocumentObserver> observers;

    public Document() {
        this.harmonics = new ArrayList<Harmonica>();
        this.observers = new ArrayList<DocumentObserver>();
    }

    public void addHarmonica(double amplitude, Formula formula, double frequency, double phase) {
        Harmonica harmonica = new Harmonica(amplitude, formula, frequency, phase);
        this.harmonics.add(harmonica);
        this.sendUpdate();
    }

    public void removeHarmonica(Harmonica harmonica) {
        this.harmonics.remove(harmonica);
        this.sendUpdate();
    }

    public void changeHarmonica(Harmonica oldHarmonica, Harmonica newHarmonica) {
        int index = this.harmonics.indexOf(oldHarmonica);
        if (index >= 0) {
            Harmonica harmonica = this.harmonics.get(index);
            harmonica.setAmplitude(newHarmonica.getAmplitude());
            harmonica.setFormula(newHarmonica.getFormula());
            harmonica.setFrequency(newHarmonica.getFrequency());
            harmonica.setPhase(newHarmonica.getPhase());
            this.sendUpdate();
        }
    }

    public ArrayList<Harmonica> getHarmonics() {
        return this.harmonics;
    }

    public void register(DocumentObserver observer) {
        this.observers.add(observer);
    }

    private void sendUpdate() {
        this.observers.forEach(DocumentObserver::update);
    }
}
