package com.lab9v1.view;

import com.lab9v1.model.Formula;
import com.lab9v1.model.Harmonica;

import javax.swing.*;
import javax.swing.event.DocumentEvent;
import javax.swing.event.DocumentListener;
import javax.swing.text.NumberFormatter;
import java.awt.event.*;
import java.text.DecimalFormat;

public class AddNewHarmonic extends JDialog {
    private JPanel contentPane;
    private JButton buttonOK;
    private JButton buttonCancel;
    private JFormattedTextField amplitudeTextField;
    private JRadioButton sinRadioButton;
    private JRadioButton cosRadioButton;
    private JFormattedTextField frequencyTextField;
    private JFormattedTextField phaseTextField;
    private JLabel resultHarmonic;
    private ButtonGroup formulaButtonGroup;

    private HarmonicaData harmonica;

    public AddNewHarmonic() {
        setContentPane(contentPane);
        setModal(true);
        getRootPane().setDefaultButton(buttonOK);
        // call onCancel() when cross is clicked
        setDefaultCloseOperation(DO_NOTHING_ON_CLOSE);

        bindEvents();
        bindRedraw();
        redrawHarmonica();
    }

    private void bindEvents() {
        buttonOK.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                onOK();
            }
        });
        buttonCancel.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                onCancel();
            }
        });
        addWindowListener(new WindowAdapter() {
            public void windowClosing(WindowEvent e) {
                onCancel();
            }
        });
        // call onCancel() on ESCAPE
        contentPane.registerKeyboardAction(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                onCancel();
            }
        }, KeyStroke.getKeyStroke(KeyEvent.VK_ESCAPE, 0), JComponent.WHEN_ANCESTOR_OF_FOCUSED_COMPONENT);
    }

    private void bindRedraw() {
        DocumentListener listener = new DocumentListener() {
            @Override
            public void insertUpdate(DocumentEvent e) {
                redrawHarmonica();
            }

            @Override
            public void removeUpdate(DocumentEvent e) {
                redrawHarmonica();
            }

            @Override
            public void changedUpdate(DocumentEvent e) {

            }
        };

        amplitudeTextField.getDocument().addDocumentListener(listener);
        frequencyTextField.getDocument().addDocumentListener(listener);
        phaseTextField.getDocument().addDocumentListener(listener);

        sinRadioButton.addItemListener(new ItemListener() {
            @Override
            public void itemStateChanged(ItemEvent event) {
                redrawHarmonica();
            }

        });
        cosRadioButton.addItemListener(new ItemListener() {
            @Override
            public void itemStateChanged(ItemEvent event) {
                redrawHarmonica();
            }

        });
    }

    private void redrawHarmonica() {
        Harmonica harmonica = new Harmonica(getAmplitude(), getFormula(), getFrequency(), getPhase());
        this.harmonica.frequency = getFrequency();
        this.harmonica.amplitude = getAmplitude();
        this.harmonica.phase = getPhase();
        this.harmonica.formula = getFormula();
        resultHarmonic.setText(harmonica.toString());
    }

    public HarmonicaData getHarmonica() {
        return this.harmonica;
    }

    private void onOK() {
        this.getData(this.harmonica);
        dispose();
    }

    private void onCancel() {
        this.harmonica = null;
        dispose();
    }

    private double getAmplitude() {
        Object value = amplitudeTextField.getValue();
        if (value == null ) return 0;
        return (Double) value;
    }

    private Formula getFormula() {
        if (cosRadioButton.isSelected()) {
            return Formula.COS;
        } else {
            return Formula.SIN;
        }
    }

    private double getFrequency() {
        Object value = frequencyTextField.getValue();
        if (value == null ) return 0;
        return (Double) value;
    }

    private double getPhase() {
        Object value = phaseTextField.getValue();
        if (value == null ) return 0;
        return (Double) value;
    }

    public void setData(HarmonicaData data) {
        amplitudeTextField.setText(Double.toString(data.amplitude));
        frequencyTextField.setText(Double.toString(data.frequency));
        phaseTextField.setText(Double.toString(data.phase));

        formulaButtonGroup.clearSelection();
        switch (data.formula) {
            case COS -> cosRadioButton.setSelected(true);
            case SIN -> sinRadioButton.setSelected(true);
        }
    }

    public void getData(HarmonicaData data) {
        data.amplitude = getAmplitude();
        data.frequency = getFrequency();
        data.phase = getPhase();
        data.formula = this.getFormula();
    }

    public boolean isModified(Harmonica data) {
        if (amplitudeTextField.getText() == null || !amplitudeTextField.getText().equals(Double.toString(data.getAmplitude())))
            return true;
        if (frequencyTextField.getText() == null || !frequencyTextField.getText().equals(Double.toString(data.getFrequency())))
            return true;
        if (phaseTextField.getText() == null || !phaseTextField.getText().equals(Double.toString(data.getPhase())))
            return true;
        if (formulaButtonGroup.getSelection() != null ? formulaButtonGroup.getSelection().equals(this.convertFromFormula(data.getFormula())) : data.getFormula() != null)
            return true;
        return false;
    }

    private Formula convertToFormula(JRadioButton button){
        if (cosRadioButton.equals(button)) {
            return Formula.COS;
        } else if (sinRadioButton.equals(button)) {
            return Formula.SIN;
        }
        return null;
    }

    private JRadioButton convertFromFormula(Formula formula){
        switch (formula) {
            case COS -> {return cosRadioButton;}
            case SIN -> {return sinRadioButton;}
        }
        return null;
    }

    private void createUIComponents() {
        DecimalFormat format = new DecimalFormat("##0.0##");
        NumberFormatter formatter = new NumberFormatter(format);
        formatter.setAllowsInvalid(false);
        formatter.setValueClass(Double.class);

        this.frequencyTextField = new JFormattedTextField(formatter);
        this.amplitudeTextField = new JFormattedTextField(formatter);
        this.phaseTextField = new JFormattedTextField(formatter);
    }
}
