package com.lab9v1.model;

import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

class HarmonicaTest {

    @Test
    void getAttributes() {
        double amplitude  = 1.1;
        Formula formula = Formula.COS;
        double frequency = 2.2;
        double phase = 3.3;

        Harmonica harmonica = new Harmonica(amplitude, formula, frequency, phase);

        assertEquals(amplitude, harmonica.getAmplitude());
        assertEquals(formula, harmonica.getFormula());
        assertEquals(frequency, harmonica.getFrequency());
        assertEquals(phase, harmonica.getPhase());
    }

    @Test
    void setAttributes() {
        double amplitude  = 1.1;
        Formula formula = Formula.COS;
        double frequency = 2.2;
        double phase = 3.3;

        double newAmplitude  = 11.11;
        Formula newFormula = Formula.SIN;
        double newFrequency = 22.22;
        double newPhase = 33.33;

        Harmonica harmonica = new Harmonica(amplitude, formula, frequency, phase);
        harmonica.setAmplitude(newAmplitude);
        harmonica.setFormula(newFormula);
        harmonica.setFrequency(newFrequency);
        harmonica.setPhase(newPhase);

        assertEquals(newAmplitude, harmonica.getAmplitude());
        assertEquals(newFormula, harmonica.getFormula());
        assertEquals(newFrequency, harmonica.getFrequency());
        assertEquals(newPhase, harmonica.getPhase());
    }

    @Test
    void testToString() {
        double amplitude  = 1.1;
        Formula formula = Formula.COS;
        double frequency = 2.2;
        double phase = 3.3;

        Harmonica harmonica = new Harmonica(amplitude, formula, frequency, phase);

        assertEquals(amplitude + "*" + formula + "(" + frequency + "*x" + "+" + phase + ")", harmonica.toString());
    }

    @Test
    void execute() {
        double amplitude  = 1.1;
        Formula formula = Formula.COS;
        double frequency = 2.2;
        double phase = 3.3;

        Harmonica harmonica = new Harmonica(amplitude, formula, frequency, phase);
        assertEquals(harmonica.calculate(0.0), -1.0862277468997514);
        assertEquals(harmonica.calculate(0.5), -0.3380661569762613);
        assertEquals(harmonica.calculate(1.0), 0.7795367517203861);
        assertEquals(harmonica.calculate(1.5), 1.0452558511543826);
        assertEquals(harmonica.calculate(2.0), 0.1687112482416508);
    }
}