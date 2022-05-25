package com.lab9v1.model;

import java.util.ArrayList;

import static org.junit.jupiter.api.Assertions.*;
import static org.mockito.Mockito.*;

class DocumentTest {

    @org.junit.jupiter.api.Test
    void addHarmonica() {

        double amplitude  = 1.1;
        Formula formula = Formula.COS;
        double frequency = 2.2;
        double phase = 3.3;

        Document document = new Document();
        document.addHarmonica(amplitude, formula, frequency, phase);

        ArrayList<ImmutableHarmonica> harmonics = document.getHarmonics();
        assertEquals(harmonics.size(), 1);

        ImmutableHarmonica harmonica = harmonics.get(0);
        assertNotNull(harmonica);
        assertEquals(amplitude, harmonica.getAmplitude());
        assertEquals(formula, harmonica.getFormula());
        assertEquals(frequency, harmonica.getFrequency());
        assertEquals(phase, harmonica.getPhase());
    }

    @org.junit.jupiter.api.Test
    void removeHarmonica() {
        Document document = new Document();
        document.addHarmonica(1.1, Formula.SIN, 2.2, 3.3);
        document.addHarmonica(4.4, Formula.COS, 5.5, 6.6);
        document.addHarmonica(7.7, Formula.COS, 8.8, 9.9);

        ArrayList<ImmutableHarmonica> harmonics = document.getHarmonics();
        assertEquals(harmonics.size(), 3);

        ImmutableHarmonica harmonica = harmonics.get(1);

        assertNotNull(harmonica);
        document.removeHarmonica(harmonica);

        assertEquals(document.getHarmonics().size(), 2);
    }

    @org.junit.jupiter.api.Test
    void changeHarmonica() {
    }

    @org.junit.jupiter.api.Test
    void getHarmonics() {
        Document document = new Document();
        document.addHarmonica(1.1, Formula.SIN, 2.2, 3.3);
        document.addHarmonica(4.4, Formula.COS, 5.5, 6.6);
        document.addHarmonica(7.7, Formula.COS, 8.8, 9.9);

        ArrayList<ImmutableHarmonica> harmonics = document.getHarmonics();
        assertEquals(document.getHarmonics().size(), 3);
    }

    @org.junit.jupiter.api.Test
    void register() {

//        Document document = new Document();
//
//        DocumentObserver observer = Mockito.mock(DocumentObserver.class);
//        document.register(observer);
//
//        verify(observer, times(2)).update();
//
//        document.addHarmonica(1.1, Formula.SIN, 2.2, 3.3);
//        document.addHarmonica(1.1, Formula.SIN, 2.2, 3.3);
    }

    @org.junit.jupiter.api.Test
    void setSelectedHarmonica() {
        Document document = new Document();
        document.addHarmonica(1.1, Formula.SIN, 2.2, 3.3);
        document.addHarmonica(4.4, Formula.COS, 5.5, 6.6);
        document.addHarmonica(7.7, Formula.COS, 8.8, 9.9);

        ArrayList<ImmutableHarmonica> harmonics = document.getHarmonics();
        assertEquals(harmonics.size(), 3);

        ImmutableHarmonica harmonica = harmonics.get(1);

        document.setSelectedHarmonica(harmonica);

        assertEquals(harmonica, document.getSelectedHarmonica());
    }

    @org.junit.jupiter.api.Test
    void setSelectedHarmonicaSetSelectedNull() {
        Document document = new Document();
        document.addHarmonica(1.1, Formula.SIN, 2.2, 3.3);
        document.addHarmonica(4.4, Formula.COS, 5.5, 6.6);
        document.addHarmonica(7.7, Formula.COS, 8.8, 9.9);

        ArrayList<ImmutableHarmonica> harmonics = document.getHarmonics();
        assertEquals(harmonics.size(), 3);

        document.setSelectedHarmonica(null);

        assertNull(document.getSelectedHarmonica());
    }
}