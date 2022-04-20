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

    public AddNewHarmonic(MainController controller) {
        this.controller = controller;

        setContentPane(contentPane);
        setModal(true);
        getRootPane().setDefaultButton(buttonOK);

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

        bindRedraw();
        redrawHarmonica();

        // call onCancel() when cross is clicked
        setDefaultCloseOperation(DO_NOTHING_ON_CLOSE);
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
                    frequencyTextField.setText(Integer.toString(0));
                }
                redrawHarmonica();
            }

            @Override
            public void removeUpdate(DocumentEvent e) {
                frequencyTextField.setText(Integer.toString(0));
                redrawHarmonica();
            }

            @Override
            public void changedUpdate(DocumentEvent e) {
                if (getFrequency() < 0) {
                    frequencyTextField.setText(Integer.toString(0));
                }
                redrawHarmonica();
            }
        });

        phaseTextField.getDocument().addDocumentListener(new DocumentListener() {
            @Override
            public void insertUpdate(DocumentEvent e) {
                if (getPhase() < 0) {
                    phaseTextField.setText(Integer.toString(0));
                }
                redrawHarmonica();
            }

            @Override
            public void removeUpdate(DocumentEvent e) {
                phaseTextField.setText(Integer.toString(0));
                redrawHarmonica();
            }

            @Override
            public void changedUpdate(DocumentEvent e) {
                if (getPhase() < 0) {
                    phaseTextField.setText(Integer.toString(0));
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
        double amplitude = getAmplitude();
        Formula formula = getFormula();
        int frequency = getFrequency();
        int phase = getPhase();

        controller.addHarmonica(amplitude, formula, frequency, phase);

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

    private int getFrequency() {
        return Integer.parseInt(frequencyTextField.getText());
    }

    private int getPhase() {
        return Integer.parseInt(phaseTextField.getText());
    }
}
