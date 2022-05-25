package com.lab9v1.model;

import java.util.ArrayList;
import java.util.concurrent.atomic.AtomicBoolean;
import java.util.concurrent.atomic.AtomicReference;

public class Document implements ImmutableDocument, UnaryFunction {
    private ArrayList<Harmonica> harmonics;
    private ArrayList<DocumentObserver> observers;

    private Harmonica selectedHarmonica;

    public Document() {
        this.harmonics = new ArrayList<Harmonica>();
        this.observers = new ArrayList<DocumentObserver>();
    }

    public void addHarmonica(double amplitude, Formula formula, double frequency, double phase) {
        Harmonica harmonica = new Harmonica(amplitude, formula, frequency, phase);
        this.harmonics.add(harmonica);
        this.sendUpdate();
    }

    public void removeHarmonica(ImmutableHarmonica harmonica) {
        this.harmonics.remove((Harmonica) harmonica);
        this.sendUpdate();
    }

    public void changeHarmonica(ImmutableHarmonica oldHarmonica, ImmutableHarmonica newHarmonica) {
        int index = this.harmonics.indexOf((Harmonica) oldHarmonica);
        if (index >= 0) {
            Harmonica harmonica = this.harmonics.get(index);
            harmonica.setAmplitude(newHarmonica.getAmplitude());
            harmonica.setFormula(newHarmonica.getFormula());
            harmonica.setFrequency(newHarmonica.getFrequency());
            harmonica.setPhase(newHarmonica.getPhase());
            this.sendUpdate();
        }
    }

    public void setSelectedHarmonica(ImmutableHarmonica harmonica) {
        if (harmonica == null) {
            selectedHarmonica = null;
            sendUpdate();
            return;
        }
        AtomicBoolean hasSelected = new AtomicBoolean(false);
        this.harmonics.forEach(item -> {
            if (item == harmonica) {
                selectedHarmonica = item;
                hasSelected.set(true);
            }
        });
        if (!hasSelected.get()) {
            selectedHarmonica = null;
        }
        sendUpdate();
    }

    public ArrayList<ImmutableHarmonica> getHarmonics() {
        return new ArrayList<ImmutableHarmonica> (this.harmonics);
    }

    public ImmutableHarmonica getSelectedHarmonica() {
        return selectedHarmonica;
    }

    public void register(DocumentObserver observer) {
        this.observers.add(observer);
    }

    private void sendUpdate() {
        this.observers.forEach(DocumentObserver::update);
    }

    @Override
    public double calculate(double x) {
        AtomicReference<Double> result = new AtomicReference<>((double) 0);
        this.harmonics.forEach(item -> {
            result.updateAndGet(v -> new Double((double) (v + item.calculate(x))));
        });
        return result.get();
    }
}
