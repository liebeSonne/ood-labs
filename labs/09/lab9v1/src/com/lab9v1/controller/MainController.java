package com.lab9v1.controller;

import com.lab9v1.model.*;
import com.lab9v1.view.HarmonicaData;
import com.lab9v1.view.HarmonicaView;

public class MainController {
    private Document document;
    private HarmonicaView view;

    public MainController(Document document, HarmonicaView $view) {
        this.document = document;
        this.view = $view;
    }

    public void onAddNewHarmonica() {
        HarmonicaData harmonica = this.view.getNewHarmonica();
        if (harmonica != null) {
            this.document.addHarmonica(harmonica.amplitude, harmonica.formula, harmonica.frequency, harmonica.phase);
        }
    }

    public void onRemoveHarmonica() {
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
