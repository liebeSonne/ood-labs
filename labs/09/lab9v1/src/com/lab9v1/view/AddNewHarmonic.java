package com.lab9v1.view;

import com.lab9v1.controller.MainController;
import com.lab9v1.model.Formula;
import com.lab9v1.model.Harmonica;

import javax.swing.*;
import javax.swing.event.ChangeEvent;
import javax.swing.event.ChangeListener;
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

    private MainController controller;
    private Harmonica harmonica;

    public AddNewHarmonic(MainController controller, Harmonica harmonica) {
        this.controller = controller;
        this.harmonica = harmonica;

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
        this.harmonica.setFrequency(getFrequency());
        this.harmonica.setAmplitude(getAmplitude());
        this.harmonica.setPhase(getPhase());
        this.harmonica.setFormula(getFormula());
        resultHarmonic.setText(this.harmonica.toString());
    }

    private void onOK() {
        this.getData(this.harmonica);
        controller.addHarmonica(this.harmonica.getAmplitude(), this.harmonica.getFormula(), this.harmonica.getFrequency(), this.harmonica.getPhase());
        dispose();
    }

    private void onCancel() {
        // add your code here if necessary
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

    public void setData(Harmonica data) {
        amplitudeTextField.setText(Double.toString(data.getAmplitude()));
        frequencyTextField.setText(Double.toString(data.getFrequency()));
        phaseTextField.setText(Double.toString(data.getPhase()));

        formulaButtonGroup.clearSelection();
        switch (data.getFormula()) {
            case COS -> cosRadioButton.setSelected(true);
            case SIN -> sinRadioButton.setSelected(true);
        }
    }

    public void getData(Harmonica data) {
        data.setAmplitude(getAmplitude());
        data.setFrequency(getFrequency());
        data.setPhase(getPhase());
        data.setFormula(this.getFormula());
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
        DecimalFormat format = new DecimalFormat("##0.###");
        NumberFormatter formatter = new NumberFormatter(format);
        formatter.setAllowsInvalid(false);
        formatter.setValueClass(Double.class);

        this.frequencyTextField = new JFormattedTextField(formatter);
        this.amplitudeTextField = new JFormattedTextField(formatter);
        this.phaseTextField = new JFormattedTextField(formatter);
    }
}
