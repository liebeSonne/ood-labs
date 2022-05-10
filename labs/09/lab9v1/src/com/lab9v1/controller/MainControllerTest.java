package com.lab9v1.controller;

import com.lab9v1.model.Document;
import com.lab9v1.model.Formula;
import com.lab9v1.model.Harmonica;
import com.lab9v1.model.ImmutableHarmonica;
import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;
import static org.mockito.Mockito.*;

class MainControllerTest {

    @Test
    void addHarmonica() {
        double amplitude  = 1.1;
        Formula formula = Formula.COS;
        double frequency = 2.2;
        double phase = 3.3;

//        Document document = mock(Document.class);
        Document document = new Document();
        MainController controller = new MainController(document);

//        verify(document, times(1)).addHarmonica(amplitude, formula, frequency, phase);

        controller.addHarmonica(amplitude, formula, frequency, phase);
        assertEquals(1, controller.getDocument().getHarmonics().size());
    }

    @Test
    void removeHarmonica() {
        double amplitude  = 1.1;
        Formula formula = Formula.COS;
        double frequency = 2.2;
        double phase = 3.3;

//        Document document = mock(Document.class);
        Document document = new Document();
        MainController controller = new MainController(document);

        controller.addHarmonica(amplitude, formula, frequency, phase);
        controller.addHarmonica(amplitude, formula, frequency, phase);

        ImmutableHarmonica harmonica = document.getHarmonics().get(0);

//        verify(document, times(1)).removeHarmonica(harmonica);

        controller.removeHarmonica(harmonica);

        assertEquals(1, controller.getDocument().getHarmonics().size());
    }

    @Test
    void getDocument() {
        Document document = new Document();
        MainController controller = new MainController(document);

        assertEquals(document, controller.getDocument());
    }

    @Test
    void changeHarmonica() {
        Document document = new Document();
        MainController controller = new MainController(document);

        assertEquals(0, controller.getDocument().getHarmonics().size());
    }
}