package com.lab9v1.controller;

import com.lab9v1.model.Document;
import com.lab9v1.model.Formula;
import com.lab9v1.model.ImmutableHarmonica;
import com.lab9v1.view.HarmonicaData;
import com.lab9v1.view.HarmonicaView;
import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

class MockView implements HarmonicaView {

    private HarmonicaData data;

    public MockView(HarmonicaData data) {
        this.data = data;
    }

    @Override
    public HarmonicaData getNewHarmonica() {
        return data;
    }
}

class MainControllerTest {

    @Test
    void onAddHarmonicaSuccess() {
        double amplitude  = 1.1;
        Formula formula = Formula.COS;
        double frequency = 2.2;
        double phase = 3.3;

        HarmonicaData data = new HarmonicaData();
        data.amplitude = amplitude;
        data.formula = formula;
        data.frequency = frequency;
        data.phase = phase;

        MockView mockView = new MockView(data);

//        Document document = mock(Document.class);
        Document document = new Document();
        MainController controller = new MainController(document, mockView);

//        verify(document, times(1)).addHarmonica(amplitude, formula, frequency, phase);

        controller.onAddNewHarmonica();
        assertEquals(1, controller.getDocument().getHarmonics().size());
        ImmutableHarmonica harmonica = (controller.getDocument().getHarmonics()).get(0);
        assertEquals(data.amplitude, harmonica.getAmplitude());
        assertEquals(data.formula, harmonica.getFormula());
        assertEquals(data.frequency, harmonica.getFrequency());
        assertEquals(data.phase, harmonica.getPhase());
    }

    @Test
    void onAddHarmonicaNotAdded() {
        double amplitude  = 1.1;
        Formula formula = Formula.COS;
        double frequency = 2.2;
        double phase = 3.3;

        HarmonicaData data = new HarmonicaData();
        data.amplitude = amplitude;
        data.formula = formula;
        data.frequency = frequency;
        data.phase = phase;

        MockView mockView = new MockView(data);

//        Document document = mock(Document.class);
        Document document = new Document();
        MainController controller = new MainController(document, mockView);

//        verify(document, times(1)).addHarmonica(amplitude, formula, frequency, phase);

        controller.onAddNewHarmonica();
        assertEquals(0, controller.getDocument().getHarmonics().size());
    }

    @Test
    void removeHarmonica() {
        double amplitude  = 1.1;
        Formula formula = Formula.COS;
        double frequency = 2.2;
        double phase = 3.3;

        HarmonicaData data = new HarmonicaData();
        data.amplitude = amplitude;
        data.formula = formula;
        data.frequency = frequency;
        data.phase = phase;

        MockView mockView = new MockView(data);

//        Document document = mock(Document.class);
        Document document = new Document();
        MainController controller = new MainController(document, mockView);

        document.addHarmonica(amplitude, formula, frequency, phase);
        document.addHarmonica(amplitude, formula, frequency, phase);

        ImmutableHarmonica harmonica = document.getHarmonics().get(0);

        controller.setSelectedHarmonica(harmonica);

//        verify(document, times(1)).removeHarmonica(harmonica);

        controller.onRemoveHarmonica();

        assertEquals(1, controller.getDocument().getHarmonics().size());
    }

    @Test
    void getDocument() {
        Document document = new Document();
        MainController controller = new MainController(document, null);

        assertEquals(document, controller.getDocument());
    }

    @Test
    void changeHarmonica() {
        Document document = new Document();
        MainController controller = new MainController(document, null);

        assertEquals(0, controller.getDocument().getHarmonics().size());
    }
}