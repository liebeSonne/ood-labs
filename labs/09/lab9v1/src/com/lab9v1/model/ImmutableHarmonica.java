package com.lab9v1.model;

public interface ImmutableHarmonica extends UnaryFunction {
    public double getAmplitude();

    public Formula getFormula();

    public double getFrequency();

    public double getPhase();

    public String toString();
}
