package com.lab9v1.model;

public class Harmonica {
    private double amplitude;
    private Formula formula;
    private int frequency;
    private int phase;

    public Harmonica(double amplitude, Formula formula, int frequency, int phase) {
        setAmplitude(amplitude);
        setFormula(formula);
        setFrequency(frequency);
        setPhase(phase);
    }

    public double getAmplitude() {
        return amplitude;
    }

    public Formula getFormula() {
        return formula;
    }

    public int getFrequency() {
        return frequency;
    }

    public int getPhase() {
        return phase;
    }

    public void setAmplitude(double amplitude) {
        this.amplitude = amplitude;
    }

    public void setFormula(Formula formula) {
        this.formula = formula;
    }

    public void setFrequency(int frequency) {
        this.frequency = frequency;
    }

    public void setPhase(int phase) {
        this.phase = phase;
    }

    @Override
    public String toString() {
        return getAmplitude() + "*" + getFormula() + "(" + getFrequency() + "*x+" + getPhase() + ")";
    }

    public double execute(double x) {
        double value = amplitude;
        double a = frequency * x + phase;
        if (formula == Formula.SIN) {
            value *= Math.sin(a);
        } else if (formula == Formula.COS) {
            value *= Math.cos(a);
        }
        return value;
    }
}
