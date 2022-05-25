package com.lab9v1.controller;

import com.lab9v1.model.*;
import com.lab9v1.view.AddNewHarmonic;

import javax.swing.*;

public class MainController {
    private Document document;

    public MainController(Document document) {
        this.document = document;
    }

    public void addHarmonica(double amplitude, Formula formula, double frequency, double phase) {
        this.document.addHarmonica(amplitude, formula, frequency, phase);
    }

    public void addNewHarmonica(HarmonicaCreator creator) {
        System.out.println("controller::addNewHarmonica()--begin");
        ImmutableHarmonica harmonica = creator.getHarmonica();
        if (harmonica != null) {
            this.document.addHarmonica(harmonica.getAmplitude(), harmonica.getFormula(), harmonica.getFrequency(), harmonica.getPhase());
        }
        System.out.println("controller::addNewHarmonica()--end");
    }

    public void removeSelectedHarmonica() {
        this.document.removeHarmonica(this.document.getSelectedHarmonica());
    }

    public ImmutableDocument getDocument() {
        return (ImmutableDocument) this.document;
    }

    public void changeSelectedHarmonica(ImmutableHarmonica newHarmonica) {
        this.document.changeHarmonica(this.getSelectedHarmonica(), newHarmonica);
    }

    public void setSelectedHarmonica(ImmutableHarmonica harmonica) {
        this.document.setSelectedHarmonica(harmonica);
    }

    public ImmutableHarmonica getSelectedHarmonica() {
        return this.document.getSelectedHarmonica();
    }
}
