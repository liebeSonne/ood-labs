package com.lab9v1.controller;

import com.lab9v1.model.Formula;
import com.lab9v1.model.Harmonica;

import java.util.ArrayList;

public class MainController {
    private ArrayList<Harmonica> harmonics;

    public MainController(ArrayList<Harmonica> harmonics) {
        this.harmonics = harmonics;
    }

    public void addHarmonica(double amplitude, Formula formula, int frequency, int phase) {
        Harmonica harmonica = new Harmonica(amplitude, formula, frequency, phase);
        harmonics.add(harmonica);
    }
}
