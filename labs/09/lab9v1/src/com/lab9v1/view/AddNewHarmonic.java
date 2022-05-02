package com.lab9v1.view;

import com.lab9v1.controller.MainController;
import com.lab9v1.model.Formula;
import com.lab9v1.model.Harmonica;

import javax.swing.*;
import javax.swing.event.DocumentEvent;
import javax.swing.event.DocumentListener;
import java.awt.event.*;

public class AddNewHarmonic extends JDialog {
    private JPanel contentPane;
    private JButton buttonOK;
    private JButton buttonCancel;
    private JTextField amplitudeTextField;
    private JRadioButton sinRadioButton;
    private JRadioButton cosRadioButton;
    private JTextField frequencyTextField;
    private JTextField phaseTextField;
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
        amplitudeTextField.getDocument().addDocumentListener(new DocumentListener() {
            @Override
            public void insertUpdate(DocumentEvent e) {
                System.out.println("amplitudeTextField.insertUpdate");
                if (getAmplitude() < 0) {
                    amplitudeTextField.setText(Double.toString(0));
                }
                redrawHarmonica();
            }

            @Override
            public void removeUpdate(DocumentEvent e) {
                System.out.println("amplitudeTextField.removeUpdate");
                amplitudeTextField.setText(Double.toString(0));
                redrawHarmonica();
            }

            @Override
            public void changedUpdate(DocumentEvent e) {
                System.out.println("amplitudeTextField.changedUpdate");
                if (getAmplitude() < 0) {
                    amplitudeTextField.setText(Double.toString(0));
                }
                redrawHarmonica();
            }
        });

        frequencyTextField.getDocument().addDocumentListener(new DocumentListener() {
            @Override
            public void insertUpdate(DocumentEvent e) {
                if (getFrequency() < 0) {
                    frequencyTextField.setText(Double.toString(0));
                }
                redrawHarmonica();
            }

            @Override
            public void removeUpdate(DocumentEvent e) {
                frequencyTextField.setText(Double.toString(0));
                redrawHarmonica();
            }

            @Override
            public void changedUpdate(DocumentEvent e) {
                if (getFrequency() < 0) {
                    frequencyTextField.setText(Double.toString(0));
                }
                redrawHarmonica();
            }
        });

        phaseTextField.getDocument().addDocumentListener(new DocumentListener() {
            @Override
            public void insertUpdate(DocumentEvent e) {
                if (getPhase() < 0) {
                    phaseTextField.setText(Double.toString(0));
                }
                redrawHarmonica();
            }

            @Override
            public void removeUpdate(DocumentEvent e) {
                phaseTextField.setText(Double.toString(0));
                redrawHarmonica();
            }

            @Override
            public void changedUpdate(DocumentEvent e) {
                if (getPhase() < 0) {
                    phaseTextField.setText(Double.toString(0));
                }
                redrawHarmonica();
            }
        });

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
        resultHarmonic.setText(harmonica.toString());
    }

    private void onOK() {
        this.setData(this.harmonica);
        controller.addHarmonica(this.harmonica.getAmplitude(), this.harmonica.getFormula(), this.harmonica.getFrequency(), this.harmonica.getPhase());
        dispose();
    }

    private void onCancel() {
        // add your code here if necessary
        dispose();
    }

    private double getAmplitude() {
        return Double.parseDouble(amplitudeTextField.getText());
    }

    private Formula getFormula() {
        if (formulaButtonGroup.getSelection().equals(cosRadioButton)) {
            return Formula.COS;
        } else {
            return Formula.SIN;
        }
    }

    private double getFrequency() {
        return Double.parseDouble(frequencyTextField.getText());
    }

    private double getPhase() {
        return Double.parseDouble(phaseTextField.getText());
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
        data.setAmplitude(Double.parseDouble(amplitudeTextField.getText()));
        data.setFrequency(Double.parseDouble(frequencyTextField.getText()));
        data.setPhase(Double.parseDouble(phaseTextField.getText()));
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
}
