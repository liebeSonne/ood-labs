package com.lab9v1.model;

public class Harmonica implements HarmonicaExecutor, HarmonicaSetter, ImmutableHarmonica {
    private double amplitude;
    private Formula formula;
    private double frequency;
    private double phase;

    public Harmonica(double amplitude, Formula formula, double frequency, double phase) {
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

    public double getFrequency() {
        return frequency;
    }

    public double getPhase() {
        return phase;
    }

    public void setAmplitude(double amplitude) {
        this.amplitude = amplitude;
    }

    public void setFormula(Formula formula) {
        this.formula = formula;
    }

    public void setFrequency(double frequency) {
        this.frequency = frequency;
    }

    public void setPhase(double phase) {
        this.phase = phase;
    }

    @Override
    public String toString() {
        return getAmplitude() + "*" + getFormula() + "(" + getFrequency() + "*x" + (getPhase() >= 0 ? "+" : "") + getPhase() + ")";
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
