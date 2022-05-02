package com.lab9v1.controller;

import com.lab9v1.model.*;

public class MainController {
    private Document document;

    public MainController(Document document) {
        this.document = document;
    }

    public void addHarmonica(double amplitude, Formula formula, double frequency, double phase) {
        this.document.addHarmonica(amplitude, formula, frequency, phase);
    }

    public void removeHarmonica(Harmonica harmonica) {
        this.document.removeHarmonica(harmonica);
    }

    public ImmutableDocument getDocument() {
        return (ImmutableDocument) this.document;
    }

    public void changeHarmonica(Harmonica oldHarmonica, Harmonica newHarmonica) {
        this.document.changeHarmonica(oldHarmonica, newHarmonica);
    }
}
